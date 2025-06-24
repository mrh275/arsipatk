<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'description' => 'Welcome to the dashboard',
            'active' => 'dashboard',
            'hasDatatable' => '0',
        ];

        return view('admin.dashboard', $data);
    }
}
