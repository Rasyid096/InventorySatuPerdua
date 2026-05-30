@extends('main')

@section('content')
<div class="min-h-[calc(100vh-100px)] flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat"
     style="background-image: url('{{ asset('assets/image/kopitiam.jpg') }}');"
     x-data="{ 
         activeTab: '{{ old('form_type', session('recovery_question') ? 'forgot' : ($errors->any() ? old('form_type', 'login') : 'login')) }}'
     }">
    
    <div class="bg-white/95 backdrop-blur-sm p-5 md:p-6 rounded-2xl shadow-2xl w-full max-w-xl animate-fade-in">
        <h2 class="text-xl md:text-2xl font-bold text-center text-gray-800 mb-6">Sistem Stok Bahan Baku</h2>

        {{-- Flash Messages --}}
        @if(session('error'))
            <x-alert type="error" class="mb-4" dismissible>{{ session('error') }}</x-alert>
        @endif
        @if(session('success'))
            <x-alert type="success" class="mb-4" dismissible>{{ session('success') }}</x-alert>
        @endif

        {{-- Tab Buttons --}}
        <div class="grid grid-cols-3 gap-1 bg-gray-100 rounded-xl p-1 mb-6">
            <button type="button" 
                    @click="activeTab = 'login'"
                    :class="activeTab === 'login' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                    class="py-2.5 px-2 text-sm font-bold rounded-lg transition-all">
                Login
            </button>
            <button type="button" 
                    @click="activeTab = 'register'"
                    :class="activeTab === 'register' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500'"
                    class="py-2.5 px-2 text-sm font-bold rounded-lg transition-all disabled:opacity-40 disabled:cursor-not-allowed"
                    {{ $canRegisterFirstUser ? '' : 'disabled' }}>
                Daftar
            </button>
            <button type="button" 
                    @click="activeTab = 'forgot'"
                    :class="activeTab === 'forgot' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                    class="py-2.5 px-2 text-sm font-bold rounded-lg transition-all">
                Lupa Pass
            </button>
        </div>

        {{-- Login Tab --}}
        <div x-show="activeTab === 'login'" x-transition>
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="form_type" value="login">

                <x-input name="username" label="Username" placeholder="Masukkan username" 
                         :value="old('username')" :error="$errors->first('username')" required />
                
                <x-input name="password" type="password" label="Password" placeholder="Masukkan password" 
                         :error="$errors->first('password')" required />

                <x-btn type="submit" class="w-full justify-center">Masuk</x-btn>
            </form>
        </div>

        {{-- Register Tab --}}
        <div x-show="activeTab === 'register'" x-transition x-cloak>
            @if($canRegisterFirstUser)
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg p-3 mb-4 text-sm">
                    Belum ada user terdaftar. Silakan buat 1 akun pertama (otomatis menjadi Admin).
                </div>
                <form action="{{ url('/register-first-user') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="form_type" value="register">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input name="nama_user" label="Nama User" :value="old('nama_user')" 
                                 :error="$errors->first('nama_user')" required />
                        <x-input name="username" label="Username" :value="old('username')" 
                                 :error="$errors->first('username')" required />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input name="password" type="password" label="Password" 
                                 :error="$errors->first('password')" required />
                        <x-input name="password_confirmation" type="password" label="Konfirmasi Password" 
                                 :error="$errors->first('password_confirmation')" required />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input name="tanggal_lahir" type="date" label="Tanggal Lahir" 
                                 :value="old('tanggal_lahir')" :error="$errors->first('tanggal_lahir')" required />
                        <x-input name="jawaban_keamanan" label="Jawaban Keamanan" :value="old('jawaban_keamanan')" 
                                 :error="$errors->first('jawaban_keamanan')" required />
                    </div>

                    <x-textarea name="pertanyaan_keamanan" label="Pertanyaan Keamanan" 
                                :value="old('pertanyaan_keamanan', 'Nama hewan peliharaan pertama Anda?')" 
                                :error="$errors->first('pertanyaan_keamanan')" required />

                    <x-btn type="submit" class="w-full justify-center">Buat Admin Pertama</x-btn>
                </form>
            @else
                <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-lg p-4 text-sm text-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Pendaftaran publik ditutup. User baru ditambahkan melalui panel admin.
                </div>
            @endif
        </div>

        {{-- Forgot Password Tab --}}
        <div x-show="activeTab === 'forgot'" x-transition x-cloak>
            {{-- Step 1: Enter Username --}}
            <form action="{{ url('/forgot-password/question') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="form_type" value="forgot">

                <x-input name="username_recovery" label="Username" placeholder="Masukkan username"
                         :value="old('username_recovery', session('recovery_username'))" 
                         :error="$errors->first('username_recovery')" required />

                <x-btn type="submit" class="w-full justify-center">Tampilkan Pertanyaan</x-btn>
            </form>

            {{-- Step 2: Answer Security Question (if available) --}}
            @if(session('recovery_question'))
                <div class="border-t border-gray-200 mt-6 pt-6">
                    <form action="{{ url('/forgot-password/reset') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="form_type" value="forgot">
                        <input type="hidden" name="username" value="{{ session('recovery_username') }}">
                        <input type="hidden" name="recovery_question" value="{{ session('recovery_question') }}">

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Username</label>
                            <input type="text" value="{{ session('recovery_username') }}" readonly
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-gray-100 cursor-not-allowed">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Pertanyaan Keamanan</label>
                            <textarea readonly rows="2"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-gray-100 cursor-not-allowed resize-none">{{ session('recovery_question') }}</textarea>
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

<style>
@keyframes fade-in {
    from { transform: translateY(30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
.animate-fade-in {
    animation: fade-in 0.5s ease forwards;
}
</style>
@endsection
