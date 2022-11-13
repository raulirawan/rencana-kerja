<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index($monitor_id)
    {
        $kegiatan = Kegiatan::where('monitor_id', $monitor_id)->get();
        return view('Admin.kegiatan.index', compact('kegiatan', 'monitor_id'));
    }

    public function store(Request $request)
    {
        $data = new Kegiatan();
        $data->kode = $request->kode;
        $data->nama_kegiatan = $request->nama_kegiatan;
        $data->monitor_id = $request->monitor_id;
        $data->sasaran_id = $request->sasaran_id;
        $data->kategori = $request->kategori;
        $data->periode_awal = $request->periode_awal;
        $data->periode_akhir = $request->periode_akhir;

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.kegiatan.index', $request->monitor_id)->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.kegiatan.index', $request->monitor_id)->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Kegiatan::findOrFail($id);

        $data->kode = $request->kode;
        $data->nama_kegiatan = $request->nama_kegiatan;
        $data->monitor_id = $request->monitor_id;
        $data->sasaran_id = $request->sasaran_id;
        $data->kategori = $request->kategori;
        $data->periode_awal = $request->periode_awal;
        $data->periode_akhir = $request->periode_akhir;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.kegiatan.index', $request->monitor_id)->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.kegiatan.index', $request->monitor_id)->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Kegiatan::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.kegiatan.index', $data->monitor_id)->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.kegiatan.index', $data->monitor_id)->with('error', 'Data Gagal di Hapus');
        }
    }
}
