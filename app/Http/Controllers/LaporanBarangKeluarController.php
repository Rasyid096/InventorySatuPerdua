<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanBarangKeluarController extends Controller
{
    private function getDataByFilter(Request $request)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $isGudangUtama = $cabangAktif === 5;

        $query = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->leftJoin('cabang as ct', 'ct.id', '=', 'ts.cabang_tujuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'bm.kategori_lokasi', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.foto', 'ts.cabang_tujuan_id', 'ct.nama_cabang as cabang_tujuan_nama')
            ->where('ts.jenis', 'Keluar')
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

        if ($isGudangUtama && $request->filled('cabang_tujuan_id')) {
            $query->where('ts.cabang_tujuan_id', (int) $request->cabang_tujuan_id);
        }

        return $query->orderBy('bm.kategori_lokasi')->orderBy('ts.tanggal', 'desc')->orderBy('ts.id', 'desc')->get();
    }

    public function index(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $filter_aktif = $request->has('filter') || $request->filled('kategori_lokasi') || $request->filled('cabang_tujuan_id');
        $isGudangUtama = (session('cabang_aktif', auth()->user()?->cabang_id ?? 1)) === 5;
        $daftarCabangTujuan = $isGudangUtama
            ? DB::table('cabang')->where('id', '!=', session('cabang_aktif', auth()->user()?->cabang_id ?? 1))->orderBy('id')->get()
            : collect();

        return view('admin.laporan_barang_keluar', [
            'data_laporan' => $data_laporan,
            'filter_aktif' => $filter_aktif,
            'request' => $request,
            'isGudangUtama' => $isGudangUtama,
            'daftarCabangTujuan' => $daftarCabangTujuan,
        ]);
    }

    public function cetak(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $isGudangUtama = (session('cabang_aktif', auth()->user()?->cabang_id ?? 1)) === 5;
        $namaCabangTujuan = null;

        if ($isGudangUtama && $request->filled('cabang_tujuan_id')) {
            $namaCabangTujuan = DB::table('cabang')->where('id', (int) $request->cabang_tujuan_id)->value('nama_cabang');
        }

        return view('admin.cetak_barang_keluar', [
            'data_laporan' => $data_laporan,
            'request' => $request,
            'isGudangUtama' => $isGudangUtama,
            'namaCabangTujuan' => $namaCabangTujuan,
        ]);
    }

    public function export(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $fileName = 'Laporan_Barang_Keluar_1_2_KopiTiam_'.date('Ymd_His').'.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $isGudangUtama = (session('cabang_aktif', auth()->user()?->cabang_id ?? 1)) === 5;
        $columns = ['No', 'Tanggal Keluar', 'Kategori', 'Nama Barang'];

        if ($isGudangUtama) {
            $columns[] = 'Cabang Tujuan';
        }

        $columns[] = 'Jumlah Keluar';
        $columns[] = 'Satuan';

        $callback = function () use ($data_laporan, $columns, $isGudangUtama) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data_laporan as $index => $item) {
                $row = [
                    $index + 1,
                    Carbon::parse($item->tanggal)->format('d-m-Y'),
                    $item->kategori_lokasi,
                    $item->nama_barang,
                ];

                if ($isGudangUtama) {
                    $row[] = $item->cabang_tujuan_nama ?: '-';
                }

                $row[] = $item->jumlah;
                $row[] = $item->satuan;

                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
