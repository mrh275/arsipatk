<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
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
}
