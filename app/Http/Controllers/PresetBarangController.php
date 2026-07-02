<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresetBarangController extends Controller
{
    public function index(Request $request)
    {
        $filterKategori = $request->input('kategori_lokasi', 'Semua');
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $query = DB::table('preset_barang')->where('cabang_id', $cabangAktif);

        if (in_array($filterKategori, ['Bar', 'Dapur'])) {
            $query->where('kategori_lokasi', $filterKategori);
        }

        $preset = $query->orderBy('kategori_lokasi')->orderBy('nama_barang', 'asc')->get();

        return view('admin.preset_barang', compact('preset', 'filterKategori'));
    }

    public function store(Request $request)
    {
        DB::table('preset_barang')->insert([
            'nama_barang' => $request->nama_barang,
            'kategori_lokasi' => $request->kategori_lokasi,
            'cabang_id' => session('cabang_aktif', auth()->user()?->cabang_id ?? 1),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ActivityLog::log('create', 'Preset Barang', 'Menambahkan preset barang baru: '.$request->nama_barang.' ('.$request->kategori_lokasi.')');

        return back()->with('success', 'Preset barang baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        DB::table('preset_barang')->where('id', $id)->where('cabang_id', $cabangAktif)->update([
            'nama_barang' => $request->nama_barang,
            'kategori_lokasi' => $request->kategori_lokasi,
            'updated_at' => now(),
        ]);

        ActivityLog::log('update', 'Preset Barang', 'Mengedit preset barang #'.$id.': '.$request->nama_barang.' ('.$request->kategori_lokasi.')');

        return back()->with('success', 'Preset barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $item = DB::table('preset_barang')->where('id', $id)->where('cabang_id', $cabangAktif)->first();
        DB::table('preset_barang')->where('id', $id)->where('cabang_id', $cabangAktif)->delete();

        ActivityLog::log('delete', 'Preset Barang', 'Menghapus preset barang: '.($item->nama_barang ?? '#'.$id));

        return back()->with('success', 'Preset barang berhasil dihapus!');
    }
}
