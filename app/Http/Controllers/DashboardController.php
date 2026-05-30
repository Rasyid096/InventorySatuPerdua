<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total_barang = DB::table('barang_master')->count();
        $total_masuk = DB::table('transaksi_stok')->where('jenis', 'Masuk')->count();
        $total_keluar = DB::table('transaksi_stok')->where('jenis', 'Keluar')->count();

        $stok_grafik = DB::table('barang_master')
                        ->orderBy('stok_saat_ini', 'desc')
                        ->limit(10)
                        ->get();

        $label_grafik = []; 
        $data_grafik = [];  

        foreach ($stok_grafik as $stok) {
            $label_grafik[] = $stok->nama_barang;
            $data_grafik[] = $stok->stok_saat_ini;
        }

        // 3. Kirim semua data ke halaman View
        return view('admin.dashboard', [
            'total_barang' => $total_barang,
            'total_masuk'  => $total_masuk,
            'total_keluar' => $total_keluar,
            'label_grafik' => $label_grafik,
            'data_grafik'  => $data_grafik
        ]);
    }
}