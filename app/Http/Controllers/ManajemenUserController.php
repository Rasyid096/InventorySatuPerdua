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

        $users = DB::table('users')->orderBy('id', 'desc')->get();

        return view('admin.manajemen_user', compact('users'));
    }

    public function store(Request $request)
    {
        DB::table('users')->insert([
            'name'      => $request->nama_user,
            'email'     => $request->username . '@stok.local',
            'nama_user' => $request->nama_user,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'hak_akses' => $request->hak_akses,
        ]);

        ActivityLog::log('create', 'User', 'Menambahkan user baru: ' . $request->nama_user . ' (' . $request->hak_akses . ')');

        return back()->with('success', 'Data User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name'      => $request->nama_user,
            'email'     => $request->username . '@stok.local',
            'nama_user' => $request->nama_user,
            'username'  => $request->username,
            'hak_akses' => $request->hak_akses,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($data);

        ActivityLog::log('update', 'User', 'Mengedit user: ' . $request->nama_user);

        return back()->with('success', 'Data User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        DB::table('users')->where('id', $id)->delete();

        ActivityLog::log('delete', 'User', 'Menghapus user: ' . ($user->nama_user ?? '#' . $id));

        return back()->with('success', 'Data User berhasil dihapus!');
    }
}
