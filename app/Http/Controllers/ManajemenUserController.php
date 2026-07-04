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

        $users = DB::table('users')
            ->where('cabang_id', $cabangAktif)
            ->orWhere('hak_akses', 'Super Admin')
            ->orderByRaw("CASE WHEN hak_akses = 'Super Admin' THEN 0 WHEN hak_akses = 'Admin Gudang' THEN 1 ELSE 2 END")
            ->orderBy('id', 'desc')
            ->get();

        $allowedRoles = $this->getAllowedRoles($cabangAktif);

        return view('admin.manajemen_user', compact('users', 'isSuperAdmin', 'cabangAktif', 'allowedRoles'));
    }

    public function store(Request $request)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $isSuperAdmin = auth()->user()?->hak_akses === 'Super Admin';

        $allowedRoles = $this->getAllowedRoles($cabangAktif);

        if (!$isSuperAdmin && !in_array($request->hak_akses, $allowedRoles)) {
            return back()->with('error', 'Anda tidak dapat menambahkan user dengan role tersebut.');
        }

        $request->validate([
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'hak_akses' => 'required|string|in:' . implode(',', $allowedRoles),
        ]);

        DB::table('users')->insert([
            'name' => $request->nama_user,
            'email' => $request->username.'@stok.local',
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'hak_akses' => $request->hak_akses,
            'cabang_id' => $cabangAktif,
        ]);

        ActivityLog::log('create', 'User', 'Menambahkan user baru: '.$request->nama_user.' ('.$request->hak_akses.')');

        return back()->with('success', 'Data User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $isSuperAdmin = auth()->user()?->hak_akses === 'Super Admin';

        $userTarget = DB::table('users')->where('id', $id)->first();

        if (!$userTarget) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        if (!$isSuperAdmin && $userTarget->hak_akses === 'Super Admin') {
            return back()->with('error', 'Anda tidak dapat mengedit user Super Admin.');
        }

        if (!$isSuperAdmin && (int) $userTarget->cabang_id !== $cabangAktif) {
            return back()->with('error', 'User tidak ditemukan pada cabang aktif.');
        }

        $allowedRoles = $this->getAllowedRoles($cabangAktif);

        if (!$isSuperAdmin && !in_array($request->hak_akses, $allowedRoles)) {
            return back()->with('error', 'Anda tidak dapat mengubah role menjadi tersebut.');
        }

        $request->validate([
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'hak_akses' => 'required|string|in:' . implode(',', $allowedRoles),
        ]);

        $data = [
            'name' => $request->nama_user,
            'email' => $request->username.'@stok.local',
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'hak_akses' => $request->hak_akses,
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

        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        if (!$isSuperAdmin && $user->hak_akses === 'Super Admin') {
            return back()->with('error', 'Anda tidak dapat menghapus user Super Admin.');
        }

        if (!$isSuperAdmin && (int) $user->cabang_id !== $cabangAktif) {
            return back()->with('error', 'User tidak ditemukan pada cabang aktif.');
        }

        DB::table('users')->where('id', $id)->delete();

        ActivityLog::log('delete', 'User', 'Menghapus user: '.($user->nama_user ?? '#'.$id));

        return back()->with('success', 'Data User berhasil dihapus!');
    }

    private function getAllowedRoles(int $cabangAktif): array
    {
        if ($cabangAktif === 5) {
            return ['Super Admin', 'Admin Gudang'];
        }

        return ['Super Admin', 'Admin', 'Karyawan'];
    }
}
