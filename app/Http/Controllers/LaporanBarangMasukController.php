<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanBarangMasukController extends Controller
{
    private function getDataByFilter(Request $request)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $query = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'bm.kategori_lokasi', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.foto', 'ts.harga_total')
            ->where('ts.jenis', 'Masuk')
            ->where('ts.cabang_id', $cabangAktif)
            ->where('bm.cabang_id', $cabangAktif);

        if ($request->has('filter')) {
            $filter = $request->filter;

            if ($filter == 'hari_ini') {
                $query->whereDate('ts.tanggal', Carbon::today());
            } elseif ($filter == 'minggu') {
                $query->whereDate('ts.tanggal', '>=', Carbon::now()->subDays(7));
            } elseif ($filter == 'bulan') {
                $query->whereDate('ts.tanggal', '>=', Carbon::now()->subDays(30));
            } elseif ($filter == 'custom') {
                $mulai = $request->tanggal_mulai;
                $sampai = $request->tanggal_sampai;
                if ($mulai && $sampai) {
                    $query->whereBetween('ts.tanggal', [$mulai, $sampai]);
                }
            }
        }

        if (in_array($request->kategori_lokasi, ['Bar', 'Dapur'])) {
            $query->where('bm.kategori_lokasi', $request->kategori_lokasi);
        }

        return $query->orderBy('bm.kategori_lokasi')->orderBy('ts.tanggal', 'desc')->orderBy('ts.id', 'desc')->get();
    }

    public function index(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $filter_aktif = $request->has('filter') || $request->filled('kategori_lokasi');
        $isGudangUtama = (session('cabang_aktif', auth()->user()?->cabang_id ?? 1)) === 5;
        $totalHarga = $data_laporan->sum('harga_total');

        return view('admin.laporan_barang_masuk', [
            'data_laporan' => $data_laporan,
            'filter_aktif' => $filter_aktif,
            'request' => $request,
            'isGudangUtama' => $isGudangUtama,
            'totalHarga' => $totalHarga,
        ]);
    }

    public function cetak(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $isGudangUtama = (session('cabang_aktif', auth()->user()?->cabang_id ?? 1)) === 5;
        $totalHarga = $data_laporan->sum('harga_total');

        return view('admin.cetak_barang_masuk', [
            'data_laporan' => $data_laporan,
            'request' => $request,
            'isGudangUtama' => $isGudangUtama,
            'totalHarga' => $totalHarga,
        ]);
    }

    public function export(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $isGudangUtama = (session('cabang_aktif', auth()->user()?->cabang_id ?? 1)) === 5;
        $fileName = 'Laporan_Barang_Masuk_1_2_KopiTiam_'.date('Ymd_His').'.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['No', 'Tanggal Masuk', 'Kategori', 'Nama Barang', 'Jumlah', 'Satuan'];
        if ($isGudangUtama) {
            $columns[] = 'Harga';
        }

        $totalHarga = 0;

        $callback = function () use ($data_laporan, $columns, $isGudangUtama, &$totalHarga) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data_laporan as $index => $item) {
                $row = [
                    $index + 1,
                    Carbon::parse($item->tanggal)->format('d-m-Y'),
                    $item->kategori_lokasi,
                    $item->nama_barang,
                    $item->jumlah,
                    $item->satuan,
                ];
                if ($isGudangUtama) {
                    $row[] = $item->harga_total;
                    $totalHarga += $item->harga_total;
                }
                fputcsv($file, $row);
            }

            if ($isGudangUtama) {
                fputcsv($file, ['', '', '', '', '', 'Total', $totalHarga]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
