<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanStokController extends Controller
{
    private function getDataByFilter(Request $request)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $query = DB::table('barang_master as bm')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('bm.id', 'bm.nama_barang', 'bm.kategori_lokasi', 'bm.stok_saat_ini as jumlah', 'sb.nama_satuan as satuan', 'bm.foto', 'bm.updated_at as tanggal')
            ->where('bm.cabang_id', $cabangAktif);

        if ($request->has('filter')) {
            $filter = $request->filter;

            if ($filter == 'hari_ini') {
                $query->whereDate('bm.updated_at', Carbon::today());
            } elseif ($filter == 'minggu') {
                $query->whereDate('bm.updated_at', '>=', Carbon::now()->subDays(7));
            } elseif ($filter == 'bulan') {
                $query->whereDate('bm.updated_at', '>=', Carbon::now()->subDays(30));
            } elseif ($filter == 'custom') {
                $mulai = $request->tanggal_mulai;
                $sampai = $request->tanggal_sampai;
                if ($mulai && $sampai) {
                    $query->whereBetween('bm.updated_at', [$mulai, $sampai]);
                }
            }
        }

        if (in_array($request->kategori_lokasi, ['Bar', 'Dapur'])) {
            $query->where('bm.kategori_lokasi', $request->kategori_lokasi);
        }

        return $query->orderBy('bm.kategori_lokasi')->orderBy('bm.nama_barang', 'asc')->get();
    }

    public function index(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $filter_aktif = $request->has('filter') || $request->filled('kategori_lokasi');

        return view('admin.laporan_stok', [
            'data_laporan' => $data_laporan,
            'filter_aktif' => $filter_aktif,
            'request' => $request,
        ]);
    }

    public function cetak(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        return view('admin.cetak_stok', ['data_laporan' => $data_laporan, 'request' => $request]);
    }

    public function export(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $fileName = 'Laporan_Stok_1_2_KopiTiam_'.date('Ymd_His').'.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['No', 'Kategori', 'Nama Barang', 'Sisa Stok', 'Satuan', 'Tanggal'];

        $callback = function () use ($data_laporan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data_laporan as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->kategori_lokasi,
                    $item->nama_barang,
                    $item->jumlah,
                    $item->satuan,
                    Carbon::parse($item->tanggal)->format('d-m-Y'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
