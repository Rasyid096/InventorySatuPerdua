<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $barang_masuk = DB::table('transaksi_stok as ts')
                        ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
                        ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
                        ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.harga_total as harga', 'ts.foto')
                        ->where('ts.jenis', 'Masuk')
                        ->orderBy('ts.id', 'desc')
                        ->get();

        $barang_keluar = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.foto')
            ->where('ts.jenis', 'Keluar')
            ->orderBy('ts.tanggal', 'desc')
            ->orderBy('ts.id', 'desc')
            ->get();

        $daftar_satuan = DB::table('satuan_barang')->get();

        $stok_tersedia = DB::table('barang_master as bm')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('bm.id', 'bm.nama_barang', 'bm.stok_saat_ini as jumlah', 'sb.nama_satuan as satuan', 'bm.foto')
            ->where('bm.stok_saat_ini', '>', 0)
            ->get();

        return view('admin.transaksi', compact('barang_masuk', 'barang_keluar', 'daftar_satuan', 'stok_tersedia'));
    }
}
