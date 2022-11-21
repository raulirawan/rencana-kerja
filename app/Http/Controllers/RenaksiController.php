<?php

namespace App\Http\Controllers;

use App\Renaksi;
use App\UkuranKeberhasilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RenaksiController extends Controller
{
    public function index($kegiatan_id)
    {
        $renaksi = Renaksi::where('kegiatan_id', $kegiatan_id)->where('skpd_id', Auth::user()->skpd_id)->get();
        return view('Admin.renaksi.index', compact('renaksi', 'kegiatan_id'));
    }

    public function detail($renaksi_id)
    {
        $renaksi = Renaksi::find($renaksi_id);


        return view('Admin.renaksi.detail', compact('renaksi'));
    }

    public function detailUkuran($ukuran_id)
    {
        $ukuran = UkuranKeberhasilan::find($ukuran_id);

        return view('Admin.renaksi.detail-ukuran-skpd', compact('ukuran'));
    }

    public function updateUkuran(Request $request)
    {
        $request->validate(
            [
                'file_pendukung.*' => 'max:2048',
            ],
            [
                'file_pendukung.*.mimes' => 'File Harus Bertipe PDF',
            ]
        );

        $ukuran = UkuranKeberhasilan::find($request->ukuran_id);

        $ukuran->target_capaian = $request->target_capaian;
        $ukuran->kendala = $request->kendala;
        // $ukuran->catatan = $request->catatan;
        $ukuran->capaian = $request->capaian;
        $ukuran->keterangan = $request->keterangan;

        if ($request->hasFile('file_pendukung')) {
            $dataFile = [];
            foreach ($request->file('file_pendukung') as $key => $val) {
                $tujuan_upload = 'file_pendukung/' . $ukuran->renaksi->kode . '/';
                $nama_file = time() . "_" . $val->getClientOriginalName();
                $nama_file = str_replace(' ', '', $nama_file);
                $val->move($tujuan_upload, $nama_file);

                $dataFile[] = $tujuan_upload . $nama_file;
            }
            if ($ukuran->file_pendukung != null) {
                $oldFile = json_decode($ukuran->file_pendukung);
                $newFile = array_merge($oldFile, $dataFile);
                $file = json_encode($newFile);
            } else {
                $file = json_encode($dataFile);
            }

            $ukuran->file_pendukung = $file;
        }

        $ukuran->save();

        if ($ukuran != null) {
            return redirect()->route('renaksi.detail', $ukuran->rencana_aksi_id)->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('renaksi.detail', $ukuran->rencana_aksi_id)->with('error', 'Data Gagal di Update');
        }
    }

    public function deleteFile($id, $keyFile)
    {
        $ukuran = UkuranKeberhasilan::findOrFail($id);

        $file = json_decode($ukuran->file_pendukung);
        $fileBaru = [];

        foreach ($file as $key => $value) {
            if ($key == $keyFile) {
                if (file_exists($value)) {
                    unlink($value);
                }
                unset($value);
            } else {
                $fileBaru[] = $value;
            }
        }

        $ukuran->file_pendukung = json_encode($fileBaru);
        $ukuran->save();
        if ($ukuran != null) {
            return redirect()->route('renaksi.ukuran.detail', $id)->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('renaksi.ukuran.detail', $id)->with('error', 'Data Gagal di Hapus');
        }
    }
}
