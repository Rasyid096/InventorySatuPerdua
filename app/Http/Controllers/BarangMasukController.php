<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = DB::table('transaksi_stok as ts')
                        ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
                        ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
                        ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.foto')
                        ->where('ts.jenis', 'Masuk')
                        ->orderBy('ts.id', 'desc')
                        ->get();

        $daftar_satuan = DB::table('satuan_barang')->get();

        return view('admin.barang_masuk', compact('barang_masuk', 'daftar_satuan'));
    }

    public function store(Request $request)
    {
        $nama_foto = '';
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . "_" . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
        }

        $satuanId = DB::table('satuan_barang')->where('nama_satuan', $request->satuan)->value('id');
        if (!$satuanId) {
            $satuanId = DB::table('satuan_barang')->insertGetId(['nama_satuan' => $request->satuan]);
        }

        $master = DB::table('barang_master')
                    ->where('nama_barang', $request->nama_barang)
                    ->first();

        if ($master) {
            DB::table('barang_master')->where('id', $master->id)->update([
                'stok_saat_ini' => $master->stok_saat_ini + $request->jumlah,
                'satuan_id' => $satuanId,
                'updated_at' => now(),
            ]);
            $barangId = $master->id;
        } else {
            $barangId = DB::table('barang_master')->insertGetId([
                'nama_barang' => $request->nama_barang,
                'satuan_id' => $satuanId,
                'stok_saat_ini' => $request->jumlah,
                'foto' => $nama_foto,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('transaksi_stok')->insert([
            'barang_id' => $barangId,
            'jenis' => 'Masuk',
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'foto' => $nama_foto,
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ActivityLog::log('create', 'BarangMasuk', 'Menambahkan barang masuk: ' . $request->nama_barang . ' (' . $request->jumlah . ' ' . $request->satuan . ')');

        return back()->with('success', 'Data barang masuk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $data = [
            'tanggal'     => $request->tanggal,
            'jumlah'      => $request->jumlah,
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . "_" . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        DB::table('transaksi_stok')->where('id', $id)->update($data);

        ActivityLog::log('update', 'BarangMasuk', 'Mengedit barang masuk #' . $id);

        return back()->with('success', 'Data barang masuk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('transaksi_stok')->where('id', $id)->delete();

        ActivityLog::log('delete', 'BarangMasuk', 'Menghapus barang masuk #' . $id);

        return back()->with('success', 'Data barang masuk berhasil dihapus!');
    }

    public function hapusSemua()
    {
        $count = DB::table('transaksi_stok')->where('jenis', 'Masuk')->count();
        DB::table('transaksi_stok')->where('jenis', 'Masuk')->delete();

        ActivityLog::log('delete', 'BarangMasuk', 'Menghapus semua data barang masuk (' . $count . ' data)');

        return back()->with('success', 'Seluruh data riwayat Barang Masuk berhasil dihapus!');
    }
}
