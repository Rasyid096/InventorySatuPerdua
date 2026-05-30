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

        return view('admin.barang_keluar', [
            'barang_keluar' => $barang_keluar,
            'stok_tersedia' => $stok_tersedia
        ]);
    }

    public function store(Request $request)
    {
        // 1. Cari barang di gudang (Data Barang)
        $barang_master = DB::table('barang_master')->where('id', $request->id_barang_master)->first();

        // 2. Tolak jika yang dikeluarkan melebihi sisa stok
        if ($request->jumlah > $barang_master->stok_saat_ini) {
            return back()->with('error', 'Gagal! Jumlah keluar melebihi sisa stok di Gudang.');
        }

        // 3. Proses Foto (Jika upload foto bukti baru, pakai itu. Jika tidak, warisi foto dari master)
        $nama_foto = $barang_master->foto;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . "_keluar_" . $foto->getClientOriginalName(); 
            $foto->move(public_path('uploads'), $nama_foto);
        }

        // 4. Potong stok
        $sisa_stok = $barang_master->stok_saat_ini - $request->jumlah;

        if ($sisa_stok <= 0) {
            // Jika habis, hilangkan dari master data
            DB::table('barang_master')->where('id', $barang_master->id)->delete();
        } else {
            DB::table('barang_master')->where('id', $barang_master->id)->update(['stok_saat_ini' => $sisa_stok, 'updated_at' => now()]);
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
            // Satuan tidak diubah karena permanen dari awal
        ];

        // Jika mengubah foto bukti keluar
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . "_keluar_" . $foto->getClientOriginalName(); 
            $foto->move(public_path('uploads'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        DB::table('transaksi_stok')->where('id', $id)->update($data);
        return back()->with('success', 'Riwayat berhasil diupdate!');
    }

    public function destroy($id)
    {
        DB::table('transaksi_stok')->where('id', $id)->delete();
        return back()->with('success', 'Riwayat berhasil dihapus!');
    }
    // Fungsi untuk menghapus semua data sekaligus
    public function hapusSemua()
    {
        // Gunakan truncate() agar data terhapus bersih dan nomor urut ID kembali ke angka 1
        // Ganti 'nama_tabelnya' dengan nama tabel database kamu yang sebenarnya
        DB::table('transaksi_stok')->where('jenis', 'Keluar')->delete();

        return back()->with('success', 'Seluruh data berhasil dihapus bersih!');
    }
}