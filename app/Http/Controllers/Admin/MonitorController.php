<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $monitor = Monitor::all();
        return view('Admin.monitor.index', compact('monitor'));
    }

    public function store(Request $request)
    {
        $data = new Monitor();
        $data->nama_monitor = $request->nama_monitor;
        $data->verifikator = $request->verifikator;
        $data->pemantau = $request->pemantau;
        $data->tahun = $request->tahun;

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.monitor.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.monitor.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Monitor::findOrFail($id);

        $data->nama_monitor = $request->nama_monitor;
        $data->verifikator = $request->verifikator;
        $data->pemantau = $request->pemantau;
        $data->tahun = $request->tahun;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.monitor.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.monitor.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Monitor::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.monitor.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.monitor.index')->with('error', 'Data Gagal di Hapus');
        }
    }

    public function dashboard($id)
    {
        $monitor = Monitor::find($id);
        return view('Admin.monitor.dashboard', compact('monitor'));
    }
}
