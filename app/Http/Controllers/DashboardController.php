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
        ];

        return view('admin.dashboard', $data);
    }
}
