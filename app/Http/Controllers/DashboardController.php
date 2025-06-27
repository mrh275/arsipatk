<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!session()->has('username')) {
            return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $data = [
            'title' => 'Dashboard',
            'dropdown' => 'dashboard',
            'active' => 'dashboard',
            'hasDatatable' => '0',
        ];

        return view('admin.dashboard', $data);
    }
}
