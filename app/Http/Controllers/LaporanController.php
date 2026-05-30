<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    private function getDataStok(Request $request)
    {
        $query = DB::table('barang_master as bm')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('bm.id', 'bm.nama_barang', 'bm.stok_saat_ini as jumlah', 'sb.nama_satuan as satuan', 'bm.foto', 'bm.updated_at as tanggal');

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

        return $query->orderBy('bm.nama_barang', 'asc')->get();
    }

    private function getDataMasuk(Request $request)
    {
        $query = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.harga_total as harga', 'ts.foto')
            ->where('ts.jenis', 'Masuk');

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

        return $query->orderBy('ts.tanggal', 'desc')->orderBy('ts.id', 'desc')->get();
    }

    private function getDataKeluar(Request $request)
    {
        $query = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.foto')
            ->where('ts.jenis', 'Keluar');

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

        return $query->orderBy('ts.tanggal', 'desc')->orderBy('ts.id', 'desc')->get();
    }

    public function index(Request $request)
    {
        $data_stok = $this->getDataStok($request);
        $data_masuk = $this->getDataMasuk($request);
        $data_keluar = $this->getDataKeluar($request);
        $filter_aktif = $request->has('filter');

        return view('admin.laporan', [
            'data_stok' => $data_stok,
            'data_masuk' => $data_masuk,
            'data_keluar' => $data_keluar,
            'filter_aktif' => $filter_aktif,
            'request' => $request,
        ]);
    }
}
