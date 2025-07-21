<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        // $data['content'] = 'setting.time_management.leave.list';
        return view('login.login');
    }

    public function register()
    {
        // $data['content'] = 'setting.time_management.leave.list';
        return view('login.register');
    }
}
