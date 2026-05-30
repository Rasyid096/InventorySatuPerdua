<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib dipanggil untuk sistem keamanan Laravel
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // 1. Menampilkan halaman login
    public function index()
    {
        // Jika user sudah login, langsung lempar ke dashboard (cegah buka halaman login lagi)
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('login', [
            'canRegisterFirstUser' => User::count() === 0,
        ]);
    }

    // 2. Memproses data dari form login
    public function proses(Request $request)
    {
        // Tangkap inputan username dan password
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        // Auth::attempt akan OTOMATIS mengecek username dan mencocokkan password yang dienkripsi (Hash)
        if (Auth::attempt($credentials)) {
            // Jika cocok, buat sesi keamanan baru agar terhindar dari peretas
            $request->session()->regenerate();
            
            // Arahkan masuk ke halaman dashboard
            return redirect()->intended(route('admin.dashboard')); 
        }

        // Jika salah ketik username/password, kembalikan dengan pesan error
        return back()->with('error', 'Username atau password salah! Silakan coba lagi.');
    }

    public function registerFirstUser(Request $request)
    {
        if (User::count() > 0) {
            return back()->with('error', 'Pendaftaran sudah ditutup. Silakan hubungi admin.');
        }

        $validated = $request->validate([
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'tanggal_lahir' => 'required|date',
            'pertanyaan_keamanan' => 'required|string|max:255',
            'jawaban_keamanan' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $validated['nama_user'],
            'email' => $validated['username'] . '@stok.local',
            'nama_user' => $validated['nama_user'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'hak_akses' => 'Admin',
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'pertanyaan_keamanan' => $validated['pertanyaan_keamanan'],
            'jawaban_keamanan' => $validated['jawaban_keamanan'],
        ]);

        return redirect('/login')->with('success', 'Akun admin pertama berhasil dibuat. Silakan login.');
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jawaban_keamanan' => 'required|string',
            'password_baru' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('forgot_step', true)
                ->with('recovery_username', $request->input('username'))
                ->with('recovery_question', $request->input('recovery_question'));
        }

        $validated = $validator->validated();

        $user = User::where('username', $validated['username'])->first();

        if (!$user || !$user->tanggal_lahir || !$user->jawaban_keamanan || !$user->pertanyaan_keamanan) {
            return back()->with('error', 'Data pemulihan akun tidak ditemukan untuk username tersebut.');
        }

        $tanggalValid = (string) $user->tanggal_lahir === $validated['tanggal_lahir'];
        $jawabanValid = Hash::check($validated['jawaban_keamanan'], $user->jawaban_keamanan);

        if (!$tanggalValid || !$jawabanValid) {
            return back()->with('error', 'Verifikasi pemulihan gagal. Periksa tanggal lahir atau jawaban keamanan.');
        }

        $user->password = $validated['password_baru'];
        $user->save();

        return redirect('/login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    public function lookupRecoveryQuestion(Request $request)
    {
        $request->validate([
            'username_recovery' => 'required|string',
        ]);

        $user = User::where('username', $request->input('username_recovery'))->first();

        if (!$user || !$user->pertanyaan_keamanan) {
            return back()->with('error', 'Username tidak ditemukan atau belum punya setup recovery.');
        }

        return back()
            ->withInput()
            ->with('forgot_step', true)
            ->with('recovery_username', $user->username)
            ->with('recovery_question', $user->pertanyaan_keamanan);
    }

    // 3. Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda berhasil keluar dari sistem.');
    }
}