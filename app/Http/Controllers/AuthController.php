<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login', [
            'canRegisterFirstUser' => !User::where('hak_akses', 'Super Admin')->exists(),
            'daftarCabang' => DB::table('cabang')->orderBy('id')->get(),
        ]);
    }

    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'cabang_id' => 'required|integer|exists:cabang,id',
        ]);

        $user = User::where('username', $request->input('username'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return back()->withInput($request->except('password'))->with('error', 'Username atau password salah! Silakan coba lagi.');
        }

        if ($user->hak_akses !== 'Super Admin' && (int) $user->cabang_id !== (int) $request->input('cabang_id')) {
            return back()->withInput($request->except('password'))->with('error', 'Akun tidak ditemukan di cabang ini.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        $cabang = DB::table('cabang')->where('id', $request->input('cabang_id'))->first();
        session([
            'cabang_aktif' => (int) $request->input('cabang_id'),
            'cabang_aktif_nama' => $cabang->nama_cabang ?? 'Cabang',
        ]);

        return redirect()->intended(route('dashboard'));
    }

    public function registerFirstUser(Request $request)
    {
        if (User::where('hak_akses', 'Super Admin')->exists()) {
            return back()->with('error', 'Pendaftaran Super Admin sudah ditutup. Silakan login atau hubungi Super Admin aktif.');
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
            'email' => $validated['username'].'@stok.local',
            'nama_user' => $validated['nama_user'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'hak_akses' => 'Super Admin',
            'cabang_id' => 1,
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'pertanyaan_keamanan' => $validated['pertanyaan_keamanan'],
            'jawaban_keamanan' => $validated['jawaban_keamanan'],
        ]);

        return redirect('/login')->with('success', 'Akun Super Admin pertama berhasil dibuat. Silakan login.');
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil keluar dari sistem.');
    }
}
