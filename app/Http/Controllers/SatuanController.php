<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = DB::table('satuan_barang')->orderBy('nama_satuan', 'asc')->get();
        return view('admin.pengaturan_satuan', ['satuan' => $satuan]);
    }

    public function store(Request $request)
    {
        DB::table('satuan_barang')->insert(['nama_satuan' => $request->nama_satuan]);
        return back()->with('success', 'Satuan baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        DB::table('satuan_barang')->where('id', $id)->update(['nama_satuan' => $request->nama_satuan]);
        return back()->with('success', 'Satuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('satuan_barang')->where('id', $id)->delete();
        return back()->with('success', 'Satuan berhasil dihapus!');
    }
}