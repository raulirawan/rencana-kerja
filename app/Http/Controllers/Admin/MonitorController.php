<?php

namespace App\Http\Controllers\Admin;

use App\Monitor;
use App\Renaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $totalB03 = Renaksi::where('monitor_id', $monitor->id)->where(['periode' => 'B03'])->count();
        $totalB06 = Renaksi::where('monitor_id', $monitor->id)->where(['periode' => 'B06'])->count();
        $totalB09 = Renaksi::where('monitor_id', $monitor->id)->where(['periode' => 'B09'])->count();
        $totalB12 = Renaksi::where('monitor_id', $monitor->id)->where(['periode' => 'B12'])->count();


        $targetTercapaiB03 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TERCAPAI', 'periode' => 'B03'])->count();
        $targetTercapaiB06 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TERCAPAI', 'periode' => 'B06'])->count();
        $targetTercapaiB09 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TERCAPAI', 'periode' => 'B09'])->count();
        $targetTercapaiB12 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TERCAPAI', 'periode' => 'B12'])->count();

        $perbaikanB03 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'PERBAIKAN', 'periode' => 'B03'])->count();
        $perbaikanB06 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'PERBAIKAN', 'periode' => 'B06'])->count();
        $perbaikanB09 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'PERBAIKAN', 'periode' => 'B09'])->count();
        $perbaikanB12 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'PERBAIKAN', 'periode' => 'B12'])->count();

        $tidakSempurnaB03 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK SEMPURNA', 'periode' => 'B03'])->count();
        $tidakSempurnaB06 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK SEMPURNA', 'periode' => 'B06'])->count();
        $tidakSempurnaB09 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK SEMPURNA', 'periode' => 'B09'])->count();
        $tidakSempurnaB12 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK SEMPURNA', 'periode' => 'B12'])->count();

        $tidakTercapaiB03 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK TERCAPAI', 'periode' => 'B03'])->count();
        $tidakTercapaiB06 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK TERCAPAI', 'periode' => 'B06'])->count();
        $tidakTercapaiB09 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK TERCAPAI', 'periode' => 'B09'])->count();
        $tidakTercapaiB12 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK TERCAPAI', 'periode' => 'B12'])->count();

        $verifikasiB03 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'VERIFIKASI', 'periode' => 'B03'])->count();
        $verifikasiB06 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'VERIFIKASI', 'periode' => 'B06'])->count();
        $verifikasiB09 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'VERIFIKASI', 'periode' => 'B09'])->count();
        $verifikasiB12 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'VERIFIKASI', 'periode' => 'B12'])->count();

        $tidakLaporB03 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK LAPOR', 'periode' => 'B03'])->count();
        $tidakLaporB06 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK LAPOR', 'periode' => 'B06'])->count();
        $tidakLaporB09 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK LAPOR', 'periode' => 'B09'])->count();
        $tidakLaporB12 = Renaksi::where('monitor_id', $monitor->id)->where(['status' => 'TIDAK LAPOR', 'periode' => 'B12'])->count();
        return view('Admin.monitor.dashboard', compact(
            'monitor',
            'targetTercapaiB03',
            'targetTercapaiB06',
            'targetTercapaiB09',
            'targetTercapaiB12',
            'perbaikanB03',
            'perbaikanB06',
            'perbaikanB09',
            'perbaikanB12',
            'tidakSempurnaB03',
            'tidakSempurnaB06',
            'tidakSempurnaB09',
            'tidakSempurnaB12',
            'tidakTercapaiB03',
            'tidakTercapaiB06',
            'tidakTercapaiB09',
            'tidakTercapaiB12',
            'verifikasiB03',
            'verifikasiB06',
            'verifikasiB09',
            'verifikasiB12',
            'tidakLaporB03',
            'tidakLaporB06',
            'tidakLaporB09',
            'tidakLaporB12',
            'totalB03',
            'totalB06',
            'totalB09',
            'totalB12',
        ));
    }
}
