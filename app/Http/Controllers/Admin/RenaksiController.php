<?php

namespace App\Http\Controllers\Admin;

use App\Ukuran;
use App\Renaksi;
use App\Kegiatan;
use App\Kriteria;
use App\UkuranKeberhasilan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $data->kode = $request->kode;
        $data->nama_renaksi = $request->nama_renaksi;
        $data->monitor_id = $kegiatan->monitor_id;
        $data->kegiatan_id = $request->kegiatan_id;
        $data->skpd_id = $request->skpd_id;
        $data->periode = $request->periode;

        $data->save();


        $data->save();

        // create ukuran kebehasilan 3x
        if ($data->periode == 'B03') {
            $bulan = [
                [
                    'nama_bulan' => 'Januari',
                    'bulan' => 1,
                ],
                [
                    'nama_bulan' => 'Februari',
                    'bulan' => 2,
                ],
                [
                    'nama_bulan' => 'Maret',
                    'bulan' => 3,
                ],
            ];
        } elseif ($data->periode == 'B06') {
            $bulan = [
                [
                    'nama_bulan' => 'April',
                    'bulan' => 4,
                ],
                [
                    'nama_bulan' => 'Mei',
                    'bulan' => 5,
                ],
                [
                    'nama_bulan' => 'Juni',
                    'bulan' => 6,
                ],
            ];
        } elseif ($data->periode == 'B09') {
            $bulan = [
                [
                    'nama_bulan' => 'Juli',
                    'bulan' => 7,
                ],
                [
                    'nama_bulan' => 'Agustus',
                    'bulan' => 8,
                ],
                [
                    'nama_bulan' => 'September',
                    'bulan' => 9,
                ],
            ];
        } else {
            $bulan = [
                [
                    'nama_bulan' => 'Oktober',
                    'bulan' => 10,
                ],
                [
                    'nama_bulan' => 'November',
                    'bulan' => 11,
                ],
                [
                    'nama_bulan' => 'Desember',
                    'bulan' => 12,
                ],
            ];
        }

        for ($x = 0; $x <= 2; $x++) {
            $ukuran = new UkuranKeberhasilan();
            $ukuran->rencana_aksi_id = $data->id;
            $ukuran->bulan = $bulan[$x]['bulan'];
            $ukuran->periode = 'TA' . $kegiatan->monitor->tahun . '-' . $bulan[$x]['nama_bulan'];
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

        $data->kode = $request->kode;
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

    public function updateKriteria(Request $request, $id)
    {
        $renaksi_id = $request->renaksi_id;
        // $renaksi = Renaksi::where('id', $renaksi_id)->first();
        $data = Kriteria::findOrFail($id);
        $data->kriteria_keberhasilan = $request->kriteria_keberhasilan;
        $data->instansi = json_encode($request->unit_kerja);

        $data->save();


        if ($data != null) {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('error', 'Data Gagal di Update');
        }
    }

    public function hapusKriteria($id)
    {
        $data = Kriteria::findOrFail($id);

        $data->delete();

        if ($data != null) {
            return redirect()->back()->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->back()->with('error', 'Data Gagal di Hapus');
        }
    }


    // ukuran
    public function storeUkuranKeberhasilan(Request $request)
    {
        $renaksi_id = $request->renaksi_id;
        // $renaksi = Renaksi::where('id', $renaksi_id)->first();
        $data = new Ukuran();
        $data->rencana_aksi_id = $renaksi_id;
        $data->ukuran_keberhasilan = $request->ukuran_keberhasilan;

        $data->save();


        if ($data != null) {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('error', 'Data Gagal di Tambah');
        }
    }

    public function updatestoreUkuranKeberhasilan(Request $request, $id)
    {
        $renaksi_id = $request->renaksi_id;
        // $renaksi = Renaksi::where('id', $renaksi_id)->first();
        $data = Ukuran::findOrFail($id);
        $data->ukuran_keberhasilan = $request->ukuran_keberhasilan;


        $data->save();


        if ($data != null) {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('error', 'Data Gagal di Update');
        }
    }

    public function hapusUkuranKeberhasilan($id)
    {
        $data = Ukuran::findOrFail($id);

        $data->delete();

        if ($data != null) {
            return redirect()->back()->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->back()->with('error', 'Data Gagal di Hapus');
        }
    }

    public function updateTargetCapaian(Request $request, $renaksi_id)
    {
        $data = Renaksi::findOrFail($renaksi_id);

        $data->target_capaian = $request->target_capaian;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.renaksi.detail', $renaksi_id)->with('error', 'Data Gagal di Update');
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

        // $ukuran->target_capaian = $request->target_capaian;
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
