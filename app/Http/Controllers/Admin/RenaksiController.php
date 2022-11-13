<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kegiatan;
use App\Kriteria;
use App\Renaksi;
use App\UkuranKeberhasilan;
use Illuminate\Http\Request;

class RenaksiController extends Controller
{
    public function index($kegiatan_id)
    {
        $renaksi = Renaksi::where('kegiatan_id', $kegiatan_id)->get();
        return view('Admin.renaksi.index', compact('renaksi', 'kegiatan_id'));
    }

    public function store(Request $request)
    {
        $kegiatan = Kegiatan::where('id', $request->kegiatan_id)->first();
        $data = new Renaksi();
        $data->nama_renaksi = $request->nama_renaksi;
        $data->monitor_id = $kegiatan->monitor_id;
        $data->kegiatan_id = $request->kegiatan_id;
        $data->skpd_id = $request->skpd_id;
        $data->periode = $request->periode;

        $data->save();

        $kode = 'KSD' . $kegiatan->monitor->tahun . '' . $data->id;

        $data->kode = $kode;
        $data->save();

        // create ukuran kebehasilan 3x


        for ($x = 1; $x <= 3; $x++) {
            $ukuran = new UkuranKeberhasilan();
            $ukuran->rencana_aksi_id = $data->id;
            $ukuran->bulan = $x;
            $ukuran->periode = 'TA' . $kegiatan->monitor->tahun . '-B0' . $x;
            $ukuran->capaian = 0;
            $ukuran->save();
        }



        if ($data != null) {
            return redirect()->route('admin.renaksi.index', $request->kegiatan_id)->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.renaksi.index', $request->kegiatan_id)->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Renaksi::findOrFail($id);

        $data->nama_renaksi = $request->nama_renaksi;
        $data->skpd_id = $request->skpd_id;
        $data->periode = $request->periode;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.renaksi.index', $request->kegiatan_id)->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.renaksi.index', $request->kegiatan_id)->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Renaksi::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.renaksi.index', $data->kegiatan_id)->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.renaksi.index', $data->kegiatan_id)->with('error', 'Data Gagal di Hapus');
        }
    }

    public function detail($renaksi_id)
    {
        $renaksi = Renaksi::find($renaksi_id);


        return view('Admin.renaksi.detail', compact('renaksi'));
    }

    public function storeKriteria(Request $request)
    {
        $renaksi_id = $request->renaksi_id;
        // $renaksi = Renaksi::where('id', $renaksi_id)->first();
        $data = new Kriteria();
        $data->rencana_aksi_id = $renaksi_id;
        $data->kriteria_keberhasilan = $request->kriteria_keberhasilan;
        $data->instansi = json_encode($request->unit_kerja);

        $data->save();


        if ($data != null) {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('error', 'Data Gagal di Tambah');
        }
    }

    public function detailUkuran($ukuran_id)
    {
        $ukuran = UkuranKeberhasilan::find($ukuran_id);
        return view('Admin.renaksi.detail-ukuran', compact('ukuran'));
    }

    public function updateUkuran(Request $request)
    {
        $ukuran = UkuranKeberhasilan::find($request->ukuran_id);

        $ukuran->catatan = $request->catatan;
        $ukuran->status = $request->status;
        if ($ukuran->bulan == 3) {
            $renaksi = Renaksi::where('id', $ukuran->rencana_aksi_id)->first();
            $renaksi->status = $request->status;

            if ($request->status == 'TERCAPAI') {
                $capaian = 100;
            } elseif ($request->status == 'PERBAIKAN') {
                $capaian = 80;
            } elseif ($request->status == 'TIDAK SEMPURNA') {
                $capaian = 60;
            } elseif ($request->status == 'TIDAK TERCAPAI') {
                $capaian = 40;
            } elseif ($request->status == 'VERIFIKASI') {
                $capaian = 20;
            } elseif ($request->status == 'TIDAK LAPOR') {
                $capaian = 0;
            }
            $renaksi->capaian = $capaian;
            $renaksi->save();
        }
        $ukuran->save();

        if ($ukuran != null) {
            return redirect()->route('admin.renaksi.detail', $ukuran->rencana_aksi_id)->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.renaksi.detail', $ukuran->rencana_aksi_id)->with('error', 'Data Gagal di Update');
        }
    }

    public function getRenaksiStatus($monitor_id, $status, $periode)
    {
        $renaksi = Renaksi::where(['monitor_id' => $monitor_id, 'status' => $status, 'periode' => $periode])->get();

        return view('Admin.renaksi.index-status', compact('renaksi'));
    }
}
