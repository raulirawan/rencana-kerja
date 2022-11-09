<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index($monitor_id)
    {
        $kegiatan = Kegiatan::where('monitor_id', $monitor_id)->get();
        return view('Admin.kegiatan.index', compact('kegiatan', 'monitor_id'));
    }
}
