<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (session()->has('username')) {
            return redirect('admin/dashboard')->with('success', 'Anda sudah login sebagai ' . session('name') . '.');
        }
        // Jika belum login, tampilkan halaman login
        $data = [
            'title' => 'Login',
            'description' => 'Login to your account',
            'active' => 'login',
        ];

        return view('login', $data);
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek kredensial pengguna
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            session(['username' => $request->username]);
            session(['name' => Auth::user()->name]); // Simpan nama pengguna di session
            session(['user_role' => Auth::user()->role]); // Simpan role pengguna di session
            return redirect()->intended('admin/dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . Auth::user()->name . '.');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->withErrors(['login_error' => 'Username atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('username');
        session()->flush();
        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }

    public function gantiPassword(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|same:new_password',
        ]);
        // Cek apakah password saat ini benar
        if (!Auth::attempt(['username' => session('username'), 'password' => $request->old_password])) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        // Ganti password
        $user = User::where('username', session('username'))->first();
        $user->password = bcrypt($request->new_password);
        $user->save();

        if ($user) {
            // Hapus session username untuk memaksa pengguna login kembali
            return redirect()->to('/admin/dashboard')->with('success', 'Password berhasil diganti.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Gagal mengganti password.']);
        }

        return redirect('admin/dashboard')->with('success', 'Password berhasil diganti.');
    }
}
