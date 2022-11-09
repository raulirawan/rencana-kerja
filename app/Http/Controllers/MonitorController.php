<?php

namespace App\Http\Controllers;

use App\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $monitor = Monitor::all();
        return view('Admin.monitor.index', compact('monitor'));
    }
}
