<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barang_keluar = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.foto')
            ->where('ts.jenis', 'Keluar')
            ->orderBy('ts.tanggal', 'desc')
            ->orderBy('ts.id', 'desc')
            ->get();

        $stok_tersedia = DB::table('barang_master as bm')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('bm.id', 'bm.nama_barang', 'bm.stok_saat_ini as jumlah', 'sb.nama_satuan as satuan', 'bm.foto')
            ->where('bm.stok_saat_ini', '>', 0)
            ->get();

        return view('admin.barang_keluar', compact('barang_keluar', 'stok_tersedia'));
    }

    public function store(Request $request)
    {
        $barang_master = DB::table('barang_master')->where('id', $request->id_barang_master)->first();

        if ($request->jumlah > $barang_master->stok_saat_ini) {
            return back()->with('error', 'Gagal! Jumlah keluar melebihi sisa stok di Gudang.');
        }

        $nama_foto = $barang_master->foto;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . "_keluar_" . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
        }

        $sisa_stok = $barang_master->stok_saat_ini - $request->jumlah;

        if ($sisa_stok <= 0) {
            DB::table('barang_master')->where('id', $barang_master->id)->delete();
        } else {
            DB::table('barang_master')->where('id', $barang_master->id)->update([
                'stok_saat_ini' => $sisa_stok,
                'updated_at' => now(),
            ]);
        }

        DB::table('transaksi_stok')->insert([
            'barang_id' => $barang_master->id,
            'jenis' => 'Keluar',
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_total' => 0,
            'foto' => $nama_foto,
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Data barang keluar berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $data = [
            'tanggal' => $request->tanggal,
            'jumlah'  => $request->jumlah,
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . "_keluar_" . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        DB::table('transaksi_stok')->where('id', $id)->update($data);

        return back()->with('success', 'Data barang keluar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('transaksi_stok')->where('id', $id)->delete();

        return back()->with('success', 'Data barang keluar berhasil dihapus!');
    }

    public function hapusSemua()
    {
        DB::table('transaksi_stok')->where('jenis', 'Keluar')->delete();

        return back()->with('success', 'Seluruh data riwayat Barang Keluar berhasil dihapus!');
    }
}
