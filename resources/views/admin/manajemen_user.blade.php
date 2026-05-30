@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<x-page-header title="Data User" :breadcrumbs="['Pengaturan', 'Manajemen User', 'Data']">
    <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-user')">Entri Data</x-btn>
</x-page-header>

@if(session('success'))
    <x-alert type="success" class="mb-4" dismissible>
        {{ session('success') }}
    </x-alert>
@endif

<x-card :padding="false">
    <div class="p-6">
        <x-data-table>
            <x-slot:header>
                <th class="px-4 py-3">No.</th>
                <th class="px-4 py-3">Nama User</th>
                <th class="px-4 py-3">Username</th>
                <th class="px-4 py-3">Hak Akses</th>
                <th class="px-4 py-3">Aksi</th>
            </x-slot:header>
            
            @forelse($users as $index => $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 font-bold text-gray-800">{{ $user->nama_user }}</td>
                    <td class="px-4 py-3">{{ $user->username }}</td>
                    <td class="px-4 py-3">
                        @if($user->hak_akses == 'Admin')
                            <x-badge variant="admin">Admin</x-badge>
                        @elseif($user->hak_akses == 'Kepala Cabang')
                            <x-badge variant="cabang">Kepala Cabang</x-badge>
                        @else
                            <x-badge variant="karyawan">Karyawan</x-badge>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <x-btn variant="warning" size="sm"
                                data-id="{{ $user->id }}" 
                                data-nama="{{ $user->nama_user }}" 
                                data-username="{{ $user->username }}" 
                                data-akses="{{ $user->hak_akses }}" 
                                onclick="openEditModal(this)">
                                <i class="fas fa-edit"></i>
                            </x-btn>
                            @if($user->username != 'admin')
                                <form action="{{ url('/admin/manajemen-user/' . $user->id) }}" method="POST" 
                                      onsubmit="return confirmDeleteForm(event, 'User ini akan dihapus permanen!')">
                                    @csrf
                                    @method('DELETE')
                                    <x-btn variant="danger" size="sm" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </x-btn>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-2 text-gray-300"></i>
                        <p>Belum ada data user</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </div>
</x-card>

{{-- Entry Modal --}}
<x-modal name="entri-user" title="Input User" maxWidth="md">
    <form id="form-entri-user" action="{{ url('/admin/manajemen-user') }}" method="POST">
        @csrf
        <x-input name="nama_user" label="Nama User" required />
        <x-input name="username" label="Username" required />
        <x-input name="password" type="password" label="Password" required />
        <x-select name="hak_akses" label="Hak Akses" required>
            <option value="">-- Pilih --</option>
            <option value="Admin">Admin</option>
            <option value="Kepala Cabang">Kepala Cabang</option>
            <option value="Karyawan">Karyawan</option>
        </x-select>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-user')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-user" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

{{-- Edit Modal --}}
<x-modal name="edit-user" title="Edit User" maxWidth="md">
    <form id="form-edit-user" action="" method="POST">
        @csrf
        @method('PUT')
        <x-input name="nama_user" label="Nama User" id="edit_nama" required />
        <x-input name="username" label="Username" id="edit_username" required />
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Password Baru</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
        </div>
        
        <x-select name="hak_akses" label="Hak Akses" id="edit_akses" required>
            <option value="Admin">Admin</option>
            <option value="Kepala Cabang">Kepala Cabang</option>
            <option value="Karyawan">Karyawan</option>
        </x-select>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-user')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-user" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>
@endsection

@push('scripts')
<script>
    function openEditModal(btn) { 
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-user' }));
        
        let id = btn.getAttribute('data-id');
        document.getElementById('edit_nama').value = btn.getAttribute('data-nama');
        document.getElementById('edit_username').value = btn.getAttribute('data-username');
        document.getElementById('edit_akses').value = btn.getAttribute('data-akses');
        
        document.getElementById('form-edit-user').action = "{{ url('/admin/manajemen-user') }}/" + id;
    }
</script>
@endpush
