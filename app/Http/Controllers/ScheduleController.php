<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // $data['content'] = 'setting.time_management.leave.list';
        return view('schedule.index');
    }
}
