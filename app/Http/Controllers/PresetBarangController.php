<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresetBarangController extends Controller
{
    public function index()
    {
        $preset = DB::table('preset_barang')->orderBy('nama_barang', 'asc')->get();

        return view('admin.preset_barang', compact('preset'));
    }

    public function store(Request $request)
    {
        DB::table('preset_barang')->insert(['nama_barang' => $request->nama_barang]);

        ActivityLog::log('create', 'Preset Barang', 'Menambahkan preset barang baru: ' . $request->nama_barang);

        return back()->with('success', 'Preset barang baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        DB::table('preset_barang')->where('id', $id)->update(['nama_barang' => $request->nama_barang]);

        ActivityLog::log('update', 'Preset Barang', 'Mengedit preset barang #' . $id . ': ' . $request->nama_barang);

        return back()->with('success', 'Preset barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = DB::table('preset_barang')->where('id', $id)->first();
        DB::table('preset_barang')->where('id', $id)->delete();

        ActivityLog::log('delete', 'Preset Barang', 'Menghapus preset barang: ' . ($item->nama_barang ?? '#' . $id));

        return back()->with('success', 'Preset barang berhasil dihapus!');
    }
}
