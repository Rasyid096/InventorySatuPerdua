<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 1. UBAH DI SINI: Sesuaikan dengan nama kolom di tabel Kopi Tiam kita
#[Fillable(['name', 'email', 'nama_user', 'username', 'password', 'hak_akses', 'tanggal_lahir', 'pertanyaan_keamanan', 'jawaban_keamanan'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // 2. TAMBAHKAN DI SINI: Mematikan pencarian kolom created_at & updated_at
    public $timestamps = false;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'jawaban_keamanan' => 'hashed',
        ];
    }
}