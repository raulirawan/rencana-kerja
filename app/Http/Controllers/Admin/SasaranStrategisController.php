<?php

namespace App\Http\Controllers\Admin;

use App\SasaranStrategis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SasaranStrategisController extends Controller
{
    public function index()
    {
        $sasaranStrategis = SasaranStrategis::all();
        return view('Admin.sasaran-strategis.index', compact('sasaranStrategis'));
    }

    public function store(Request $request)
    {
        $data = new SasaranStrategis();
        $data->nama_sasaran = $request->nama_sasaran;

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.sasaran-strategis.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.sasaran-strategis.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = SasaranStrategis::findOrFail($id);

        $data->nama_sasaran = $request->nama_sasaran;

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.sasaran-strategis.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.sasaran-strategis.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = SasaranStrategis::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.sasaran-strategis.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.sasaran-strategis.index')->with('error', 'Data Gagal di Hapus');
        }
    }
}
