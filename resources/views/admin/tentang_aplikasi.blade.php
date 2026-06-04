@extends('layouts.admin')

@section('title', 'Tentang Aplikasi')

@section('content')
<x-page-header title="Tentang Aplikasi" :breadcrumbs="['Bantuan', 'Tentang Aplikasi']" />

<div class="bg-gradient-to-r from-brand-700 via-brand-800 to-teal-800 rounded-2xl p-6 mb-6 text-white relative overflow-hidden">
    <div class="absolute right-0 top-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center shrink-0">
            <x-icon name="boxes" class="w-10 h-10" />
        </div>
        <div class="text-center md:text-left">
            <h2 class="text-xl sm:text-2xl font-bold mb-2">Sistem Informasi Persediaan Bahan Baku</h2>
            <p class="text-sm text-brand-100">1/2 Kopi Tiam — Inventory Management System</p>
            <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-4">
                <span class="inline-flex items-center gap-1.5 bg-white/20 px-3 py-1 rounded-full text-xs font-medium">
                    <x-icon name="laravel" class="w-3.5 h-3.5" /> Laravel 13
                </span>
                <span class="inline-flex items-center gap-1.5 bg-white/20 px-3 py-1 rounded-full text-xs font-medium">
                    <x-icon name="php" class="w-3.5 h-3.5" /> PHP 8.4
                </span>
                <span class="inline-flex items-center gap-1.5 bg-white/20 px-3 py-1 rounded-full text-xs font-medium">
                    <x-icon name="database" class="w-3.5 h-3.5" /> MySQL
                </span>
                <span class="inline-flex items-center gap-1.5 bg-white/20 px-3 py-1 rounded-full text-xs font-medium">
                    <x-icon name="css3-alt" class="w-3.5 h-3.5" /> TailwindCSS
                </span>
                <span class="inline-flex items-center gap-1.5 bg-white/20 px-3 py-1 rounded-full text-xs font-medium">
                    <x-icon name="eye" class="w-3.5 h-3.5" /> Lucide Icons
                </span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <x-card>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-11 h-11 bg-brand-100 rounded-xl flex items-center justify-center">
                    <x-icon name="laptop-code" class="w-6 h-6 text-brand-700" />
                </div>
                <div>
                    <h3 class="text-section-title">Detail Sistem Informasi</h3>
                    <p class="text-caption">Deskripsi dan fungsi aplikasi</p>
                </div>
            </div>
            <div class="text-body space-y-3">
                <p>
                    <strong class="text-zinc-900">Sistem Informasi Persediaan Bahan Baku (Inventory System)</strong>
                    dirancang untuk memfasilitasi manajemen logistik pada <strong class="text-brand-700">1/2 Kopi Tiam</strong>.
                </p>
                <p>
                    Sistem mengotomatisasi pencatatan pergerakan stok, dari pemasukan bahan baku hingga pemakaian harian.
                    Dengan <em>Role-Based Access Control (RBAC)</em>, integritas data antar cabang dapat terpantau secara akurat.
                </p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-zinc-100">
                <div class="text-center p-3 bg-blue-50 rounded-xl">
                    <x-icon name="box" class="w-5 h-5 text-blue-600 mx-auto mb-2" />
                    <p class="text-xs font-semibold text-zinc-700">Master Data</p>
                </div>
                <div class="text-center p-3 bg-green-50 rounded-xl">
                    <x-icon name="sign-in-alt" class="w-5 h-5 text-green-600 mx-auto mb-2" />
                    <p class="text-xs font-semibold text-zinc-700">Barang Masuk</p>
                </div>
                <div class="text-center p-3 bg-orange-50 rounded-xl">
                    <x-icon name="sign-out-alt" class="w-5 h-5 text-orange-600 mx-auto mb-2" />
                    <p class="text-xs font-semibold text-zinc-700">Barang Keluar</p>
                </div>
                <div class="text-center p-3 bg-purple-50 rounded-xl">
                    <x-icon name="chart-line" class="w-5 h-5 text-purple-600 mx-auto mb-2" />
                    <p class="text-xs font-semibold text-zinc-700">Laporan</p>
                </div>
            </div>
        </x-card>

        <x-card :padding="false">
            <div class="flex flex-col sm:flex-row items-center gap-6 p-6">
                <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center shrink-0">
                    <x-icon name="file-pdf" class="w-8 h-8 text-red-500" />
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h4 class="text-section-title mb-1">Buku Panduan Penggunaan</h4>
                    <p class="text-body mb-4">
                        Unduh dokumen PDF untuk instruksi operasional dan panduan mengatasi kendala pada sistem.
                    </p>
                    <x-btn icon="cloud-download-alt" href="{{ asset('downloads/Panduan_Sistem_Stok_Kopi_Tiam.pdf') }}" target="_blank" data-no-transition>
                        Download PDF Panduan
                    </x-btn>
                </div>
            </div>
        </x-card>
    </div>

    <div class="lg:col-span-1">
        <x-card :padding="false">
            <div class="bg-gradient-to-br from-zinc-700 to-zinc-800 px-6 py-8 text-white text-center rounded-t-xl">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full border-4 border-white/30 overflow-hidden bg-white/10">
                    <img src="{{ asset('images/rasyid.png') }}" alt="Foto Pengembang" class="w-full h-full object-cover">
                </div>
                <h4 class="text-lg font-bold">Abdurrasyid</h4>
                <span class="inline-block mt-2 bg-brand-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                    Mahasiswa Peneliti
                </span>
            </div>
            <div class="p-6">
                <h5 class="text-card-title mb-4 flex items-center gap-2">
                    <x-icon name="id-badge" class="w-5 h-5 text-brand-600" />
                    Profil Pengembang
                </h5>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 bg-zinc-100 rounded-lg flex items-center justify-center shrink-0">
                            <x-icon name="id-card" class="w-4 h-4 text-zinc-500" />
                        </div>
                        <div>
                            <p class="text-caption">NIM</p>
                            <p class="font-semibold text-zinc-900">15220721</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 bg-zinc-100 rounded-lg flex items-center justify-center shrink-0">
                            <x-icon name="graduation-cap" class="w-4 h-4 text-zinc-500" />
                        </div>
                        <div>
                            <p class="text-caption">Program Studi</p>
                            <p class="font-semibold text-zinc-900">Ilmu Komputer</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 bg-zinc-100 rounded-lg flex items-center justify-center shrink-0">
                            <x-icon name="university" class="w-4 h-4 text-zinc-500" />
                        </div>
                        <div>
                            <p class="text-caption">Perguruan Tinggi</p>
                            <p class="font-semibold text-zinc-900">Universitas Bina Sarana Informatika</p>
                        </div>
                    </li>
                </ul>
                <div class="mt-6 pt-4 border-t border-zinc-100">
                    <h6 class="text-caption font-bold text-brand-700 uppercase mb-3 flex items-center gap-1">
                        <x-icon name="chalkboard-teacher" class="w-4 h-4" />
                        Dosen Pembimbing
                    </h6>
                    <ul class="space-y-2 text-sm text-zinc-700">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-brand-500 rounded-full"></span>
                            Windi Irmayani
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-brand-500 rounded-full"></span>
                            Muhammad Ifan Rifani Ihsan
                        </li>
                    </ul>
                </div>
            </div>
        </x-card>
    </div>
</div>
@endsection
