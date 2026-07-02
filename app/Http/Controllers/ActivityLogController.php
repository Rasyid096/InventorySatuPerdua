<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $query = ActivityLog::with('user')
            ->where('cabang_id', $cabangAktif)
            ->latest();

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        if ($request->filled('model')) {
            $query->where('model', $request->model);
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $logs = $query->paginate(20)->withQueryString();

        $users = User::where('cabang_id', $cabangAktif)
            ->orWhere('hak_akses', 'Super Admin')
            ->orderBy('nama_user')
            ->get();

        return view('admin.activity_log', compact('logs', 'users'));
    }

    public function hapusSemua()
    {
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);
        $jumlah = ActivityLog::where('cabang_id', $cabangAktif)->count();

        ActivityLog::where('cabang_id', $cabangAktif)->delete();

        return back()->with('success', 'Berhasil menghapus '.$jumlah.' log aktivitas pada cabang aktif.');
    }
}
