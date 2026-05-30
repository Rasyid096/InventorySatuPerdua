<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataBarangController extends Controller
{
    public function index()
    {
        $data_barang = DB::table('barang_master as bm')
            ->leftJoin('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select(
                'bm.id',
                'bm.nama_barang',
                'bm.stok_saat_ini as jumlah',
                'sb.nama_satuan as satuan',
                'bm.foto',
                'bm.updated_at as tanggal'
            )
            ->orderBy('bm.nama_barang', 'asc')
            ->get();

        $daftar_satuan = DB::table('satuan_barang')->get();

        return view('admin.data_barang', compact('data_barang', 'daftar_satuan'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama_barang'  => $request->nama_barang,
            'stok_saat_ini' => $request->jumlah,
        ];

        if ($request->filled('satuan')) {
            $satuanId = DB::table('satuan_barang')->where('nama_satuan', $request->satuan)->value('id');
            if ($satuanId) {
                $data['satuan_id'] = $satuanId;
            }
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . "_" . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        DB::table('barang_master')->where('id', $id)->update($data);

        return back()->with('success', 'Data Master Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('barang_master')->where('id', $id)->delete();

        return back()->with('success', 'Data Master Barang berhasil dihapus!');
    }

    public function hapusSemua()
    {
        DB::table('barang_master')->truncate();

        return back()->with('success', 'Seluruh data barang berhasil dihapus!');
    }
}
