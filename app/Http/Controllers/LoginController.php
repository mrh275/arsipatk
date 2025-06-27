<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (session()->has('username')) {
            return redirect('admin/dashboard')->with('success', 'Anda sudah login sebagai ' . session('username') . '.');
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
            return redirect()->intended('admin/dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . $request->username . '.');
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
}
