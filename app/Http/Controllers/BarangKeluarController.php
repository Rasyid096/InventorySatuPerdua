<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $filterKategori = $request->input('kategori_lokasi', 'Bar');
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $query = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'bm.kategori_lokasi', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.foto')
            ->where('ts.jenis', 'Keluar')
            ->where('ts.cabang_id', $cabangAktif)
            ->where('bm.cabang_id', $cabangAktif);

        if (in_array($filterKategori, ['Bar', 'Dapur'])) {
            $query->where('bm.kategori_lokasi', $filterKategori);
        }

        $barang_keluar = $query->orderBy('ts.tanggal', 'desc')->orderBy('ts.id', 'desc')->get();

        $stok_tersedia = DB::table('barang_master as bm')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('bm.id', 'bm.nama_barang', 'bm.kategori_lokasi', 'bm.stok_saat_ini as jumlah', 'sb.nama_satuan as satuan', 'bm.foto')
            ->where('bm.cabang_id', $cabangAktif)
            ->where('bm.stok_saat_ini', '>', 0)
            ->when(in_array($filterKategori, ['Bar', 'Dapur']), function ($query) use ($filterKategori) {
                $query->where('bm.kategori_lokasi', $filterKategori);
            })
            ->orderBy('bm.kategori_lokasi')
            ->orderBy('bm.nama_barang')
            ->get();

        return view('admin.barang_keluar', compact('barang_keluar', 'stok_tersedia', 'filterKategori'));
    }

    public function store(Request $request)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $barang_master = DB::table('barang_master')->where('id', $request->id_barang_master)->where('cabang_id', $cabangAktif)->first();

        if (!$barang_master) {
            return back()->with('error', 'Gagal! Data barang tidak ditemukan di master data cabang aktif.');
        }

        if ($request->jumlah > $barang_master->stok_saat_ini) {
            return back()->with('error', 'Gagal! Jumlah keluar melebihi sisa stok di Gudang.');
        }

        $nama_foto = $barang_master->foto;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time().'_keluar_'.$foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
        }

        $sisa_stok = $barang_master->stok_saat_ini - $request->jumlah;

        DB::table('transaksi_stok')->insert([
            'barang_id' => $barang_master->id,
            'cabang_id' => $cabangAktif,
            'jenis' => 'Keluar',
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_total' => 0,
            'foto' => $nama_foto,
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('barang_master')->where('id', $barang_master->id)->where('cabang_id', $cabangAktif)->update([
            'stok_saat_ini' => $sisa_stok,
            'updated_at' => now(),
        ]);

        ActivityLog::log('create', 'BarangKeluar', 'Menambahkan barang keluar: '.$barang_master->nama_barang.' ('.$barang_master->kategori_lokasi.', '.$request->jumlah.')');

        return back()->with('success', 'Data barang keluar berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $transaksi = DB::table('transaksi_stok')->where('id', $id)->where('cabang_id', $cabangAktif)->first();
        if (!$transaksi) {
            return back()->with('error', 'Data barang keluar tidak ditemukan.');
        }

        $data = [
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time().'_keluar_'.$foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        DB::table('transaksi_stok')->where('id', $id)->where('cabang_id', $cabangAktif)->update($data);
        DB::table('barang_master')->where('id', $transaksi->barang_id)->where('cabang_id', $cabangAktif)->update([
            'kategori_lokasi' => $request->kategori_lokasi,
            'updated_at' => now(),
        ]);

        ActivityLog::log('update', 'BarangKeluar', 'Mengedit barang keluar #'.$id.' ('.$request->kategori_lokasi.')');

        return back()->with('success', 'Data barang keluar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        DB::table('transaksi_stok')->where('id', $id)->where('cabang_id', $cabangAktif)->delete();

        ActivityLog::log('delete', 'BarangKeluar', 'Menghapus barang keluar #'.$id);

        return back()->with('success', 'Data barang keluar berhasil dihapus!');
    }

    public function hapusSemua()
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $count = DB::table('transaksi_stok')->where('cabang_id', $cabangAktif)->where('jenis', 'Keluar')->count();
        DB::table('transaksi_stok')->where('cabang_id', $cabangAktif)->where('jenis', 'Keluar')->delete();

        ActivityLog::log('delete', 'BarangKeluar', 'Menghapus semua data barang keluar ('.$count.' data)');

        return back()->with('success', 'Seluruh data riwayat Barang Keluar berhasil dihapus!');
    }
}
