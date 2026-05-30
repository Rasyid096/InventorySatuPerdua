<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = DB::table('satuan_barang')->orderBy('nama_satuan', 'asc')->get();

        return view('admin.pengaturan_satuan', compact('satuan'));
    }

    public function store(Request $request)
    {
        DB::table('satuan_barang')->insert(['nama_satuan' => $request->nama_satuan]);

        ActivityLog::log('create', 'Satuan', 'Menambahkan satuan baru: ' . $request->nama_satuan);

        return back()->with('success', 'Satuan baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        DB::table('satuan_barang')->where('id', $id)->update(['nama_satuan' => $request->nama_satuan]);

        ActivityLog::log('update', 'Satuan', 'Mengedit satuan #' . $id . ': ' . $request->nama_satuan);

        return back()->with('success', 'Satuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = DB::table('satuan_barang')->where('id', $id)->first();
        DB::table('satuan_barang')->where('id', $id)->delete();

        ActivityLog::log('delete', 'Satuan', 'Menghapus satuan: ' . ($item->nama_satuan ?? '#' . $id));

        return back()->with('success', 'Satuan berhasil dihapus!');
    }
}
