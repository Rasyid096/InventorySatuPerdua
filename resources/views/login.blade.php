@extends('main')

@section('title', 'Masuk')

@section('content')
<div class="min-h-[calc(100vh-120px)] flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat"
     style="background-image: url('{{ asset('assets/image/kopitiam.jpg') }}');"
     x-data="{
         activeTab: '{{ old('form_type', session('recovery_question') ? 'forgot' : ($errors->any() ? old('form_type', 'login') : 'login')) }}'
     }">

    <div class="bg-white/95 backdrop-blur-sm p-5 md:p-8 rounded-2xl shadow-2xl w-full max-w-xl animate-fade-in border border-white/50">
        <h2 class="text-page-title text-center mb-6">Sistem Stok Bahan Baku</h2>

        @if(session('error'))
            <x-alert type="error" class="mb-4" dismissible>{{ session('error') }}</x-alert>
        @endif
        @if(session('success'))
            <x-alert type="success" class="mb-4" dismissible>{{ session('success') }}</x-alert>
        @endif

        <div class="grid grid-cols-3 gap-1 bg-zinc-100 rounded-xl p-1 mb-6">
            <button type="button"
                    @click="activeTab = 'login'"
                    :class="activeTab === 'login' ? 'bg-white text-brand-700 shadow-sm' : 'text-zinc-500 hover:text-zinc-700'"
                    class="py-2.5 px-2 text-sm font-semibold rounded-lg transition-all">
                Login
            </button>
            <button type="button"
                    @click="activeTab = 'register'"
                    :class="activeTab === 'register' ? 'bg-white text-brand-700 shadow-sm' : 'text-zinc-500'"
                    class="py-2.5 px-2 text-sm font-semibold rounded-lg transition-all disabled:opacity-40 disabled:cursor-not-allowed"
                    {{ $canRegisterFirstUser ? '' : 'disabled' }}>
                Daftar
            </button>
            <button type="button"
                    @click="activeTab = 'forgot'"
                    :class="activeTab === 'forgot' ? 'bg-white text-brand-700 shadow-sm' : 'text-zinc-500 hover:text-zinc-700'"
                    class="py-2.5 px-2 text-sm font-semibold rounded-lg transition-all">
                Lupa Pass
            </button>
        </div>

        <div x-show="activeTab === 'login'" x-transition>
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="form_type" value="login">
                <x-input name="username" label="Username" placeholder="Masukkan username"
                         :value="old('username')" :error="$errors->first('username')" required />
                <x-input name="password" type="password" label="Password" placeholder="Masukkan password"
                         :error="$errors->first('password')" required />
                <x-select name="cabang_id" label="Pilih Cabang" :error="$errors->first('cabang_id')" required>
                    <option value="">-- Pilih Cabang --</option>
                    @foreach($daftarCabang as $cabang)
                        <option value="{{ $cabang->id }}" {{ old('cabang_id') == $cabang->id ? 'selected' : '' }}>Cabang {{ $cabang->nama_cabang }}</option>
                    @endforeach
                </x-select>
                <x-btn type="submit" class="w-full justify-center">Masuk</x-btn>
            </form>
        </div>

        <div x-show="activeTab === 'register'" x-transition x-cloak>
            @if($canRegisterFirstUser)
                <x-alert type="info" class="mb-4">
                    Belum ada user terdaftar. Silakan buat 1 akun pertama (otomatis menjadi Super Admin).
                </x-alert>
                <form action="{{ url('/register-first-user') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="form_type" value="register">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input name="nama_user" label="Nama User" :value="old('nama_user')" :error="$errors->first('nama_user')" required />
                        <x-input name="username" label="Username" :value="old('username')" :error="$errors->first('username')" required />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input name="password" type="password" label="Password" :error="$errors->first('password')" required />
                        <x-input name="password_confirmation" type="password" label="Konfirmasi Password" :error="$errors->first('password_confirmation')" required />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input name="tanggal_lahir" type="date" label="Tanggal Lahir" :value="old('tanggal_lahir')" :error="$errors->first('tanggal_lahir')" required />
                        <x-input name="jawaban_keamanan" label="Jawaban Keamanan" :value="old('jawaban_keamanan')" :error="$errors->first('jawaban_keamanan')" required />
                    </div>
                    <x-textarea name="pertanyaan_keamanan" label="Pertanyaan Keamanan"
                                :value="old('pertanyaan_keamanan', 'Nama hewan peliharaan pertama Anda?')"
                                :error="$errors->first('pertanyaan_keamanan')" required />
                    <x-btn type="submit" class="w-full justify-center">Buat Super Admin Pertama</x-btn>
                </form>
            @else
                <x-alert type="info">
                    Pendaftaran Super Admin ditutup. User baru ditambahkan melalui panel Super Admin/Admin.
                </x-alert>
            @endif
        </div>

        <div x-show="activeTab === 'forgot'" x-transition x-cloak>
            <form action="{{ url('/forgot-password/question') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="form_type" value="forgot">
                <x-input name="username_recovery" label="Username" placeholder="Masukkan username"
                         :value="old('username_recovery', session('recovery_username'))"
                         :error="$errors->first('username_recovery')" required />
                <x-btn type="submit" class="w-full justify-center">Tampilkan Pertanyaan</x-btn>
            </form>

            @if(session('recovery_question'))
                <div class="border-t border-zinc-200 mt-6 pt-6">
                    <form action="{{ url('/forgot-password/reset') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="form_type" value="forgot">
                        <input type="hidden" name="username" value="{{ session('recovery_username') }}">
                        <input type="hidden" name="recovery_question" value="{{ session('recovery_question') }}">

                        <div class="mb-4">
                            <label class="text-label block mb-2">Username</label>
                            <input type="text" value="{{ session('recovery_username') }}" readonly
                                   class="w-full h-9 px-3 border border-zinc-200 rounded-lg text-sm bg-zinc-100 cursor-not-allowed">
                        </div>

                        <div class="mb-4">
                            <label class="text-label block mb-2">Pertanyaan Keamanan</label>
                            <textarea readonly rows="2"
                                      class="w-full px-3 py-2 border border-zinc-200 rounded-lg text-sm bg-zinc-100 cursor-not-allowed resize-none">{{ session('recovery_question') }}</textarea>
                        </div>

                        <x-input name="tanggal_lahir" type="date" label="Tanggal Lahir"
                                 :value="old('tanggal_lahir')" :error="$errors->first('tanggal_lahir')" required />
                        <x-input name="jawaban_keamanan" label="Jawaban Keamanan"
                                 :value="old('jawaban_keamanan')" :error="$errors->first('jawaban_keamanan')" required />
                        <x-input name="password_baru" type="password" label="Password Baru"
                                 :error="$errors->first('password_baru')" required />
                        <x-input name="password_baru_confirmation" type="password" label="Konfirmasi Password Baru"
                                 :error="$errors->first('password_baru_confirmation')" required />
                        <x-btn type="submit" class="w-full justify-center">Reset Password</x-btn>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
