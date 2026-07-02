<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataBarangController extends Controller
{
    public function index(Request $request)
    {
        $filterKategori = $request->input('kategori_lokasi', 'Semua');
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $query = DB::table('barang_master as bm')
            ->leftJoin('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('bm.id', 'bm.nama_barang', 'bm.stok_saat_ini as jumlah', 'bm.kategori_lokasi', 'sb.nama_satuan as satuan', 'bm.foto', 'bm.updated_at as tanggal')
            ->where('bm.cabang_id', $cabangAktif);

        if (in_array($filterKategori, ['Bar', 'Dapur'])) {
            $query->where('bm.kategori_lokasi', $filterKategori);
        }

        $data_barang = $query->orderBy('bm.kategori_lokasi')->orderBy('bm.nama_barang', 'asc')->get();

        foreach ($data_barang as $barang) {
            $barang->riwayat = DB::table('transaksi_stok as ts')
                ->where('ts.barang_id', $barang->id)
                ->where('ts.cabang_id', $cabangAktif)
                ->select('ts.id', 'ts.tanggal', 'ts.jenis', 'ts.jumlah')
                ->orderBy('ts.tanggal', 'desc')
                ->limit(5)
                ->get();
        }

        $riwayatQuery = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->leftJoin('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'ts.jenis', 'ts.jumlah', 'bm.nama_barang', 'bm.kategori_lokasi', 'sb.nama_satuan as satuan', 'ts.harga_total')
            ->where('ts.cabang_id', $cabangAktif)
            ->where('bm.cabang_id', $cabangAktif);

        if (in_array($filterKategori, ['Bar', 'Dapur'])) {
            $riwayatQuery->where('bm.kategori_lokasi', $filterKategori);
        }

        $riwayat_terbaru = $riwayatQuery->orderBy('ts.created_at', 'desc')->limit(15)->get();
        $daftar_satuan = DB::table('satuan_barang')->get();

        return view('admin.data_barang', compact('data_barang', 'daftar_satuan', 'riwayat_terbaru', 'filterKategori'));
    }

    public function update(Request $request, $id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $data = [
            'nama_barang' => $request->nama_barang,
            'stok_saat_ini' => $request->jumlah,
            'kategori_lokasi' => $request->kategori_lokasi,
        ];

        if ($request->filled('satuan')) {
            $satuanId = DB::table('satuan_barang')->where('nama_satuan', $request->satuan)->value('id');
            if ($satuanId) {
                $data['satuan_id'] = $satuanId;
            }
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time().'_'.$foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        DB::table('barang_master')->where('id', $id)->where('cabang_id', $cabangAktif)->update($data);

        ActivityLog::log('update', 'DataBarang', 'Mengedit data barang: '.$request->nama_barang.' ('.$request->kategori_lokasi.')');

        return back()->with('success', 'Data Master Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $item = DB::table('barang_master')->where('id', $id)->where('cabang_id', $cabangAktif)->first();
        DB::table('barang_master')->where('id', $id)->where('cabang_id', $cabangAktif)->delete();

        ActivityLog::log('delete', 'DataBarang', 'Menghapus data barang: '.($item->nama_barang ?? '#'.$id));

        return back()->with('success', 'Data Master Barang berhasil dihapus!');
    }

    public function hapusSemua()
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $count = DB::table('barang_master')->where('cabang_id', $cabangAktif)->count();
        DB::table('barang_master')->where('cabang_id', $cabangAktif)->delete();

        ActivityLog::log('delete', 'DataBarang', 'Menghapus semua data barang ('.$count.' data)');

        return back()->with('success', 'Seluruh data barang berhasil dihapus!');
    }
}
