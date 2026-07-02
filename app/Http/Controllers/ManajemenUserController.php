<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    public function index()
    {
        if (auth()->user()?->hak_akses == 'Karyawan') {
            return abort(403, 'Akses Ditolak! Halaman ini hanya untuk Administrator.');
        }

        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $isSuperAdmin = auth()->user()?->hak_akses === 'Super Admin';

        $users = DB::table('users as u')
            ->join('cabang as c', 'c.id', '=', 'u.cabang_id')
            ->select('u.*', 'c.nama_cabang')
            ->where(function ($query) use ($cabangAktif) {
                $query->where('u.cabang_id', $cabangAktif)
                    ->orWhere('u.hak_akses', 'Super Admin');
            })
            ->orderByRaw("CASE WHEN u.hak_akses = 'Super Admin' THEN 0 ELSE 1 END")
            ->orderBy('u.id', 'desc')
            ->get();

        $daftarCabang = DB::table('cabang')->orderBy('id')->get();

        return view('admin.manajemen_user', compact('users', 'daftarCabang', 'isSuperAdmin'));
    }

    public function store(Request $request)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $isSuperAdmin = auth()->user()?->hak_akses === 'Super Admin';

        if (!$isSuperAdmin && $request->hak_akses === 'Super Admin') {
            return back()->with('error', 'Admin tidak dapat menambahkan user dengan role Super Admin.');
        }

        $cabangId = $isSuperAdmin ? (int) $request->cabang_id : $cabangAktif;

        DB::table('users')->insert([
            'name' => $request->nama_user,
            'email' => $request->username.'@stok.local',
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'hak_akses' => $request->hak_akses,
            'cabang_id' => $cabangId,
        ]);

        ActivityLog::log('create', 'User', 'Menambahkan user baru: '.$request->nama_user.' ('.$request->hak_akses.')');

        return back()->with('success', 'Data User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $isSuperAdmin = auth()->user()?->hak_akses === 'Super Admin';

        $userTarget = DB::table('users')->where('id', $id)
            ->when(!$isSuperAdmin, function ($query) use ($cabangAktif) {
                $query->where('cabang_id', $cabangAktif);
            })
            ->first();

        if (!$userTarget) {
            return back()->with('error', 'User tidak ditemukan pada cabang aktif.');
        }

        if (!$isSuperAdmin && $userTarget->hak_akses === 'Super Admin') {
            return back()->with('error', 'Admin tidak dapat mengedit user Super Admin.');
        }

        if (!$isSuperAdmin && $request->hak_akses === 'Super Admin') {
            return back()->with('error', 'Admin tidak dapat mengubah role menjadi Super Admin.');
        }

        $data = [
            'name' => $request->nama_user,
            'email' => $request->username.'@stok.local',
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'hak_akses' => $request->hak_akses,
            'cabang_id' => $isSuperAdmin ? (int) $request->cabang_id : $cabangAktif,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($data);

        ActivityLog::log('update', 'User', 'Mengedit user: '.$request->nama_user);

        return back()->with('success', 'Data User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $isSuperAdmin = auth()->user()?->hak_akses === 'Super Admin';

        $user = DB::table('users')->where('id', $id)
            ->when(!$isSuperAdmin, function ($query) use ($cabangAktif) {
                $query->where('cabang_id', $cabangAktif);
            })
            ->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan pada cabang aktif.');
        }

        if (!$isSuperAdmin && $user->hak_akses === 'Super Admin') {
            return back()->with('error', 'Admin tidak dapat menghapus user Super Admin.');
        }

        DB::table('users')->where('id', $id)->delete();

        ActivityLog::log('delete', 'User', 'Menghapus user: '.($user->nama_user ?? '#'.$id));

        return back()->with('success', 'Data User berhasil dihapus!');
    }
}
