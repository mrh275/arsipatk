<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
