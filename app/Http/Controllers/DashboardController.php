<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $total_barang = DB::table('barang_master')->where('cabang_id', $cabangAktif)->count();
        $total_masuk = DB::table('transaksi_stok')->where('cabang_id', $cabangAktif)->where('jenis', 'Masuk')->count();
        $total_keluar = DB::table('transaksi_stok')->where('cabang_id', $cabangAktif)->where('jenis', 'Keluar')->count();

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

        return view('admin.dashboard', [
            'total_barang' => $total_barang,
            'total_masuk' => $total_masuk,
            'total_keluar' => $total_keluar,
            'label_grafik' => $label_grafik,
            'data_grafik' => $data_grafik,
        ]);
    }
}
