@extends('layouts.admin')

@section('title', 'Backup Database')

@section('content')
<x-page-header title="Backup Database Sistem" :breadcrumbs="['Pengaturan', 'Backup Database']" />

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- Main Backup Card --}}
    <div class="lg:col-span-2">
        <x-card :padding="false">
            <div class="relative overflow-hidden">
                {{-- Header dengan gradient --}}
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-8 text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-database text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Cadangan Database</h3>
                            <p class="text-emerald-100 text-sm mt-1">Simpan salinan data untuk keamanan</p>
                        </div>
                    </div>
                </div>
                
                {{-- Content --}}
                <div class="p-6">
                    {{-- Warning Box --}}
                    <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg mb-6">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-exclamation-triangle text-amber-500 text-lg mt-0.5"></i>
                            <div>
                                <h4 class="font-bold text-amber-800">Penting!</h4>
                                <p class="text-sm text-amber-700 mt-1">
                                    Lakukan backup database secara berkala untuk mengamankan riwayat transaksi barang masuk, barang keluar, dan master data bahan baku dari risiko kehilangan data.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Database Info --}}
                    <div class="bg-gray-50 rounded-xl p-5 mb-6">
                        <h4 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-server text-emerald-600"></i>
                            Informasi Database
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-white rounded-lg p-4 border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Database Aktif</p>
                                <p class="font-mono text-sm font-bold text-gray-800 bg-gray-100 px-2 py-1 rounded inline-block">
                                    {{ $nama_db }}
                                </p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Total Tabel</p>
                                <p class="text-2xl font-bold text-emerald-600">{{ $jumlah_tabel }}</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Format Output</p>
                                <p class="font-medium text-gray-800">
                                    <i class="fas fa-file-code text-blue-500 mr-1"></i> SQL Script (.sql)
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Download Button --}}
                    <div class="text-center">
                        <x-btn size="lg" icon="download" href="{{ url('/admin/backup-database/download') }}" class="px-8">
                            Download Cadangan Database
                        </x-btn>
                        <p class="text-xs text-gray-500 mt-3">
                            <i class="fas fa-info-circle mr-1"></i>
                            File akan diunduh dalam format .sql yang dapat diimpor kembali
                        </p>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
    
    {{-- Sidebar Info --}}
    <div class="lg:col-span-1 space-y-4">
        {{-- Tips Card --}}
        <x-card>
            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-lightbulb text-amber-500"></i>
                Tips Backup
            </h4>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-start gap-2">
                    <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
                    <span>Lakukan backup minimal 1x seminggu</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
                    <span>Simpan file backup di tempat terpisah (cloud/USB)</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
                    <span>Beri nama file dengan tanggal backup</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
                    <span>Test restore berkala untuk memastikan backup valid</span>
                </li>
            </ul>
        </x-card>
        
        {{-- What's Included Card --}}
        <x-card>
            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-box-open text-blue-500"></i>
                Data yang Di-backup
            </h4>
            <ul class="space-y-2 text-sm">
                <li class="flex items-center gap-2 text-gray-600">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Master Data Barang
                </li>
                <li class="flex items-center gap-2 text-gray-600">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    Riwayat Barang Masuk
                </li>
                <li class="flex items-center gap-2 text-gray-600">
                    <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                    Riwayat Barang Keluar
                </li>
                <li class="flex items-center gap-2 text-gray-600">
                    <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                    Data Pengguna
                </li>
                <li class="flex items-center gap-2 text-gray-600">
                    <span class="w-2 h-2 bg-pink-500 rounded-full"></span>
                    Pengaturan Satuan
                </li>
            </ul>
        </x-card>
        
        {{-- Last Backup Info --}}
        <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg p-5 text-white">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase">Rekomendasi</p>
                    <p class="font-bold">Backup Rutin</p>
                </div>
            </div>
            <p class="text-sm text-gray-300">
                Jadwalkan backup rutin setiap akhir pekan untuk memastikan data selalu aman.
            </p>
        </div>
    </div>
</div>
@endsection
