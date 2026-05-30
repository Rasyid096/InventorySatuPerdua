<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    public function index(Request $request)
    {
        $satuan = DB::table('satuan_barang')->orderBy('nama_satuan', 'asc')->get();

        $users = DB::table('users')->orderBy('id', 'desc')->get();

        $logQuery = ActivityLog::with('user')->latest();

        if ($request->filled('action')) {
            $logQuery->where('action', $request->action);
        }
        if ($request->filled('model')) {
            $logQuery->where('model', $request->model);
        }
        if ($request->filled('user_id')) {
            $logQuery->where('user_id', $request->user_id);
        }

        $logs = $logQuery->paginate(20)->withQueryString();

        $nama_db = env('DB_DATABASE', 'users');
        $tables = DB::select('SHOW TABLES');
        $jumlah_tabel = count($tables);

        return view('admin.pengaturan', compact(
            'satuan',
            'users',
            'logs',
            'nama_db',
            'jumlah_tabel'
        ));
    }
}
