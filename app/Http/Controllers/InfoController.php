<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        // $data['content'] = 'setting.time_management.leave.list';
        return view('info.index');
    }
}
