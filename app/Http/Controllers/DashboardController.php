<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $isGudangUtama = $cabangAktif === 5;

        // Statistik dasar
        $total_barang = DB::table('barang_master')->where('cabang_id', $cabangAktif)->count();
        $total_masuk = DB::table('transaksi_stok')->where('cabang_id', $cabangAktif)->where('jenis', 'Masuk')->count();
        $total_keluar = DB::table('transaksi_stok')->where('cabang_id', $cabangAktif)->where('jenis', 'Keluar')->count();

        // Stok per kategori
        $stok_bar = DB::table('barang_master')->where('cabang_id', $cabangAktif)->where('kategori_lokasi', 'Bar')->sum('stok_saat_ini');
        $stok_dapur = DB::table('barang_master')->where('cabang_id', $cabangAktif)->where('kategori_lokasi', 'Dapur')->sum('stok_saat_ini');

        // Barang dengan stok menipis (stok < 5, ambil nama satuan)
        $barang_menipis = DB::table('barang_master as bm')
            ->leftJoin('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->where('bm.cabang_id', $cabangAktif)
            ->where('bm.stok_saat_ini', '<', 5)
            ->where('bm.stok_saat_ini', '>', 0)
            ->select('bm.nama_barang', 'bm.stok_saat_ini', 'sb.nama_satuan as satuan')
            ->orderBy('bm.stok_saat_ini', 'asc')
            ->limit(10)
            ->get();

        // Barang stok kosong (dengan detail nama + satuan)
        $barang_kosong = DB::table('barang_master as bm')
            ->leftJoin('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->where('bm.cabang_id', $cabangAktif)
            ->where('bm.stok_saat_ini', 0)
            ->select('bm.nama_barang', 'bm.stok_saat_ini', 'sb.nama_satuan as satuan')
            ->orderBy('bm.nama_barang', 'asc')
            ->get();

        // Total satuan terpakai
        $total_satuan = DB::table('satuan_barang')->count();

        // Total user aktif di cabang ini
        $total_user = DB::table('users')->where('cabang_id', $cabangAktif)->count();

        // Log aktivitas 5 terbaru
        $log_terbaru = ActivityLog::with('user')
            ->where('cabang_id', $cabangAktif)
            ->latest()
            ->limit(5)
            ->get();

        // Grafik stok (top 10)
        $stok_grafik = DB::table('barang_master')
            ->where('cabang_id', $cabangAktif)
            ->orderBy('stok_saat_ini', 'desc')
            ->limit(10)
            ->get();

        $label_grafik = [];
        $data_grafik = [];

        foreach ($stok_grafik as $stok) {
            $label_grafik[] = $stok->nama_barang;
            $data_grafik[] = $stok->stok_saat_ini;
        }

        // Data khusus Gudang Utama
        $cabang_tujuan_aktif = collect();
        $total_pengirim = 0;
        $total_harga_masuk = 0;

        if ($isGudangUtama) {
            // Cabang yang pernah menerima kiriman dari Gudang Utama
            $cabang_tujuan_aktif = DB::table('transaksi_stok as ts')
                ->join('cabang as c', 'c.id', '=', 'ts.cabang_tujuan_id')
                ->where('ts.cabang_id', $cabangAktif)
                ->where('ts.jenis', 'Keluar')
                ->whereNotNull('ts.cabang_tujuan_id')
                ->select('c.id', 'c.nama_cabang', DB::raw('COUNT(ts.id) as total_kiriman'), DB::raw('SUM(ts.jumlah) as total_barang'))
                ->groupBy('c.id', 'c.nama_cabang')
                ->orderByDesc('total_kiriman')
                ->get();

            // Total barang masuk dengan harga
            $total_harga_masuk = DB::table('transaksi_stok')
                ->where('cabang_id', $cabangAktif)
                ->where('jenis', 'Masuk')
                ->sum('harga_total');

            // Total pengirim (nama pengambil) unik
            $total_pengirim = DB::table('transaksi_stok')
                ->where('cabang_id', $cabangAktif)
                ->where('jenis', 'Keluar')
                ->whereNotNull('nama_pengambil_barang')
                ->distinct('nama_pengambil_barang')
                ->count('nama_pengambil_barang');
        }

        return view('admin.dashboard', compact(
            'total_barang',
            'total_masuk',
            'total_keluar',
            'stok_bar',
            'stok_dapur',
            'barang_menipis',
            'barang_kosong',
            'total_satuan',
            'total_user',
            'log_terbaru',
            'label_grafik',
            'data_grafik',
            'isGudangUtama',
            'cabang_tujuan_aktif',
            'total_pengirim',
            'total_harga_masuk',
        ));
    }
}
