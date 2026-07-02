<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $filterKategori = $request->input('kategori_lokasi', 'Bar');
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $query = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'bm.kategori_lokasi', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.foto')
            ->where('ts.jenis', 'Masuk')
            ->where('ts.cabang_id', $cabangAktif)
            ->where('bm.cabang_id', $cabangAktif);

        if (in_array($filterKategori, ['Bar', 'Dapur'])) {
            $query->where('bm.kategori_lokasi', $filterKategori);
        }

        $barang_masuk = $query->orderBy('ts.id', 'desc')->get();

        $daftar_satuan = DB::table('satuan_barang')->get();
        $preset_barang = DB::table('preset_barang')
            ->where('cabang_id', $cabangAktif)
            ->orderBy('kategori_lokasi')
            ->orderBy('nama_barang', 'asc')
            ->get();

        return view('admin.barang_masuk', compact('barang_masuk', 'daftar_satuan', 'preset_barang', 'filterKategori'));
    }

    public function store(Request $request)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $nama_foto = '';
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time().'_'.$foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
        }

        $preset = DB::table('preset_barang')->where('cabang_id', $cabangAktif)->where('nama_barang', $request->nama_barang)->first();
        $kategoriLokasi = $preset->kategori_lokasi ?? $request->input('kategori_lokasi', 'Bar');

        $satuanId = DB::table('satuan_barang')->where('nama_satuan', $request->satuan)->value('id');
        if (!$satuanId) {
            $satuanId = DB::table('satuan_barang')->insertGetId(['nama_satuan' => $request->satuan]);
        }

        $master = DB::table('barang_master')
            ->where('cabang_id', $cabangAktif)
            ->where('nama_barang', $request->nama_barang)
            ->where('kategori_lokasi', $kategoriLokasi)
            ->first();

        if ($master) {
            DB::table('barang_master')->where('id', $master->id)->where('cabang_id', $cabangAktif)->update([
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
                'kategori_lokasi' => $kategoriLokasi,
                'cabang_id' => $cabangAktif,
                'foto' => $nama_foto,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('transaksi_stok')->insert([
            'barang_id' => $barangId,
            'cabang_id' => $cabangAktif,
            'jenis' => 'Masuk',
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'foto' => $nama_foto,
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ActivityLog::log('create', 'BarangMasuk', 'Menambahkan barang masuk: '.$request->nama_barang.' ('.$kategoriLokasi.', '.$request->jumlah.' '.$request->satuan.')');

        return back()->with('success', 'Data barang masuk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $transaksi = DB::table('transaksi_stok')->where('id', $id)->where('cabang_id', $cabangAktif)->first();
        if (!$transaksi) {
            return back()->with('error', 'Data barang masuk tidak ditemukan.');
        }

        $data = [
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time().'_'.$foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        DB::table('transaksi_stok')->where('id', $id)->where('cabang_id', $cabangAktif)->update($data);
        DB::table('barang_master')->where('id', $transaksi->barang_id)->where('cabang_id', $cabangAktif)->update([
            'kategori_lokasi' => $request->kategori_lokasi,
            'updated_at' => now(),
        ]);

        ActivityLog::log('update', 'BarangMasuk', 'Mengedit barang masuk #'.$id.' ('.$request->kategori_lokasi.')');

        return back()->with('success', 'Data barang masuk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        DB::table('transaksi_stok')->where('id', $id)->where('cabang_id', $cabangAktif)->delete();

        ActivityLog::log('delete', 'BarangMasuk', 'Menghapus barang masuk #'.$id);

        return back()->with('success', 'Data barang masuk berhasil dihapus!');
    }

    public function hapusSemua()
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $count = DB::table('transaksi_stok')->where('cabang_id', $cabangAktif)->where('jenis', 'Masuk')->count();
        DB::table('transaksi_stok')->where('cabang_id', $cabangAktif)->where('jenis', 'Masuk')->delete();

        ActivityLog::log('delete', 'BarangMasuk', 'Menghapus semua data barang masuk ('.$count.' data)');

        return back()->with('success', 'Seluruh data riwayat Barang Masuk berhasil dihapus!');
    }
}
