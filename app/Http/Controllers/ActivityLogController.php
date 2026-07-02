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
        $isSuperAdmin = auth()->user()?->hak_akses === 'Super Admin';

        $query = ActivityLog::with('user')
            ->when(!$isSuperAdmin, function ($query) use ($cabangAktif) {
                $query->where('cabang_id', $cabangAktif);
            })
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

        $users = User::when(!$isSuperAdmin, function ($query) use ($cabangAktif) {
            $query->where('cabang_id', $cabangAktif);
        })->orderBy('nama_user')->get();

        return view('admin.activity_log', compact('logs', 'users'));
    }
}
