<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'dropdown' => 'dashboard',
            'active' => 'dashboard',
            'hasDatatable' => '0',
        ];

        return view('admin.dashboard', $data);
    }
}
