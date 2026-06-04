@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
<x-page-header title="Log Aktivitas" :breadcrumbs="['Pengaturan', 'Log Aktivitas']">
    <span class="text-sm text-zinc-500">{{ $logs->total() }} catatan</span>
</x-page-header>

<x-card>
    <form method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6 pb-4 border-b border-zinc-100">
        <div>
            <label class="block text-xs font-semibold text-zinc-500 mb-1">Aksi</label>
            <select name="action" class="w-full px-3 py-2 border border-zinc-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-600/20">
                <option value="">Semua</option>
                <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>Create</option>
                <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>Update</option>
                <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>Delete</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-zinc-500 mb-1">Modul</label>
            <select name="model" class="w-full px-3 py-2 border border-zinc-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-600/20">
                <option value="">Semua</option>
                <option value="BarangMasuk" {{ request('model') == 'BarangMasuk' ? 'selected' : '' }}>Barang Masuk</option>
                <option value="BarangKeluar" {{ request('model') == 'BarangKeluar' ? 'selected' : '' }}>Barang Keluar</option>
                <option value="DataBarang" {{ request('model') == 'DataBarang' ? 'selected' : '' }}>Data Barang</option>
                <option value="Satuan" {{ request('model') == 'Satuan' ? 'selected' : '' }}>Satuan</option>
                <option value="User" {{ request('model') == 'User' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-zinc-500 mb-1">User</label>
            <select name="user_id" class="w-full px-3 py-2 border border-zinc-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-600/20">
                <option value="">Semua</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->nama_user }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end gap-2">
            <x-btn type="submit" icon="filter" variant="primary">Filter</x-btn>
            <a href="{{ url('/admin/activity-log') }}" class="px-3.5 py-2 text-sm text-zinc-600 hover:text-zinc-900 border border-zinc-200 rounded-lg">Reset</a>
        </div>
    </form>

    <x-data-table>
        <x-slot:header>
            <th class="px-4 py-3">Waktu</th>
            <th class="px-4 py-3">User</th>
            <th class="px-4 py-3">Aksi</th>
            <th class="px-4 py-3">Modul</th>
            <th class="px-4 py-3">Deskripsi</th>
            <th class="px-4 py-3">IP</th>
        </x-slot:header>

        @forelse($logs as $log)
            <tr class="hover:bg-zinc-50 transition-colors">
                <td class="px-4 py-3 text-sm text-zinc-500 whitespace-nowrap">{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                <td class="px-4 py-3 font-bold text-zinc-900">{{ $log->user->nama_user ?? '-' }}</td>
                <td class="px-4 py-3">
                    @if($log->action == 'create')
                        <x-badge variant="success">Create</x-badge>
                    @elseif($log->action == 'update')
                        <x-badge variant="warning">Update</x-badge>
                    @elseif($log->action == 'delete')
                        <x-badge variant="danger">Delete</x-badge>
                    @else
                        <x-badge>{{ $log->action }}</x-badge>
                    @endif
                </td>
                <td class="px-4 py-3 text-sm text-zinc-600">{{ $log->model }}</td>
                <td class="px-4 py-3 text-sm text-zinc-700">{{ $log->description }}</td>
                <td class="px-4 py-3 text-xs text-zinc-400">{{ $log->ip_address }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-zinc-500">
                    <x-icon name="clipboard-list" class="w-10 h-10 text-zinc-300 mx-auto mb-2 block" />
                    <p>Belum ada log aktivitas</p>
                </td>
            </tr>
        @endforelse
    </x-data-table>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</x-card>
@endsection
