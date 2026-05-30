@extends('layouts.admin')

@section('title', 'Tentang Aplikasi')

@section('content')
<x-page-header title="Tentang Aplikasi" :breadcrumbs="['Bantuan', 'Tentang Aplikasi']" />

{{-- Hero Section --}}
<div class="bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-700 rounded-2xl p-8 mb-6 text-white relative overflow-hidden">
    <div class="absolute right-0 top-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute left-20 bottom-0 w-32 h-32 bg-white/5 rounded-full translate-y-1/2"></div>
    
    <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
        <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-boxes text-5xl"></i>
        </div>
        <div class="text-center md:text-left">
            <h2 class="text-2xl md:text-3xl font-bold mb-2">Sistem Informasi Persediaan Bahan Baku</h2>
            <p class="text-emerald-100 text-lg">1/2 Kopi Tiam - Inventory Management System</p>
            <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-4">
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                    <i class="fab fa-laravel mr-1"></i> Laravel 11/13
                </span>
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                    <i class="fab fa-php mr-1"></i> PHP 8.3
                </span>
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                    <i class="fas fa-database mr-1"></i> MySQL
                </span>
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                    <i class="fab fa-css3-alt mr-1"></i> TailwindCSS
                </span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- Left Column --}}
    <div class="lg:col-span-2 space-y-6">
        
        {{-- About System Card --}}
        <x-card>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-laptop-code text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Detail Sistem Informasi</h3>
                    <p class="text-sm text-gray-500">Deskripsi dan fungsi aplikasi</p>
                </div>
            </div>
            
            <div class="prose prose-sm max-w-none text-gray-600">
                <p class="leading-relaxed">
                    <strong class="text-gray-800">Sistem Informasi Persediaan Bahan Baku (Inventory System)</strong> ini dirancang dan dikembangkan khusus untuk memfasilitasi kebutuhan manajemen logistik pada <strong class="text-emerald-600">1/2 Kopi Tiam</strong>. 
                </p>
                <p class="leading-relaxed mt-3">
                    Sistem ini mengotomatisasi pencatatan pergerakan stok barang, mulai dari pemasukan bahan baku dari <em>supplier</em>, hingga pemakaian bahan harian oleh karyawan. Dengan penerapan <em>Role-Based Access Control (RBAC)</em>, integritas dan keamanan data antar cabang (Sepakat 2 & Reformasi) dapat terpantau secara <em>real-time</em> dan akurat.
                </p>
            </div>
            
            {{-- Features Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-gray-100">
                <div class="text-center p-3 bg-blue-50 rounded-xl">
                    <i class="fas fa-box text-blue-600 text-xl mb-2"></i>
                    <p class="text-xs font-bold text-gray-700">Master Data</p>
                </div>
                <div class="text-center p-3 bg-green-50 rounded-xl">
                    <i class="fas fa-sign-in-alt text-green-600 text-xl mb-2"></i>
                    <p class="text-xs font-bold text-gray-700">Barang Masuk</p>
                </div>
                <div class="text-center p-3 bg-orange-50 rounded-xl">
                    <i class="fas fa-sign-out-alt text-orange-600 text-xl mb-2"></i>
                    <p class="text-xs font-bold text-gray-700">Barang Keluar</p>
                </div>
                <div class="text-center p-3 bg-purple-50 rounded-xl">
                    <i class="fas fa-chart-line text-purple-600 text-xl mb-2"></i>
                    <p class="text-xs font-bold text-gray-700">Laporan</p>
                </div>
            </div>
        </x-card>

        {{-- Download Guide Card --}}
        <x-card :padding="false">
            <div class="flex flex-col sm:flex-row items-center gap-6 p-6">
                <div class="w-20 h-20 bg-red-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-file-pdf text-red-500 text-4xl"></i>
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h4 class="text-lg font-bold text-gray-800 mb-1">Buku Panduan Penggunaan</h4>
                    <p class="text-sm text-gray-500 mb-4">
                        Unduh dokumen PDF untuk melihat instruksi operasional, penjelasan Hak Akses, serta panduan mengatasi kendala pada sistem.
                    </p>
                    <x-btn icon="cloud-download-alt" href="{{ asset('downloads/Panduan_Sistem_Stok_Kopi_Tiam.pdf') }}" target="_blank">
                        Download PDF Panduan
                    </x-btn>
                </div>
            </div>
        </x-card>

    </div>

    {{-- Right Column - Developer Profile --}}
    <div class="lg:col-span-1">
        <x-card :padding="false">
            {{-- Profile Header --}}
            <div class="bg-gradient-to-br from-gray-700 to-gray-800 px-6 py-8 text-white text-center rounded-t-lg">
                <div class="w-24 h-24 mx-auto mb-4 rounded-full border-4 border-white/30 overflow-hidden bg-white/10">
                    <img src="{{ asset('images/rasyid.png') }}" alt="Foto Pengembang" class="w-full h-full object-cover">
                </div>
                <h4 class="text-xl font-bold">Abdurrasyid</h4>
                <span class="inline-block mt-2 bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    Mahasiswa Peneliti
                </span>
            </div>
            
            {{-- Profile Details --}}
            <div class="p-6">
                <h5 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-id-badge text-emerald-600"></i>
                    Profil Pengembang
                </h5>
                
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-id-card text-gray-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">NIM</p>
                            <p class="font-bold text-gray-800">15220721</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-graduation-cap text-gray-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Program Studi</p>
                            <p class="font-bold text-gray-800">Ilmu Komputer</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-university text-gray-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Perguruan Tinggi</p>
                            <p class="font-bold text-gray-800">Universitas Bina Sarana Informatika</p>
                        </div>
                    </li>
                </ul>

                {{-- Mentor --}}
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <h6 class="text-xs font-bold text-emerald-600 uppercase mb-3">
                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                        Dosen Pembimbing
                    </h6>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                            Windi Irmayani
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                            Muhammad Ifan Rifani Ihsan
                        </li>
                    </ul>
                </div>
            </div>
        </x-card>
    </div>

</div>
@endsection
