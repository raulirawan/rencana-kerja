<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Skpd;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function index()
    {
        $skpd = Skpd::all();
        return view('Admin.skpd.index', compact('skpd'));
    }

    public function store(Request $request)
    {
        $data = new Skpd();
        $data->nama_skpd = $request->nama_skpd;

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.skpd.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.skpd.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Skpd::findOrFail($id);

        $data->nama_skpd = $request->nama_skpd;

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.skpd.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.skpd.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Skpd::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.skpd.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.skpd.index')->with('error', 'Data Gagal di Hapus');
        }
    }
}
