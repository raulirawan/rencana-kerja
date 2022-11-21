@extends('layouts.dashboard-admin')

@section('title', 'Halaman Renaksi')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Renaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Renaksi</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail Rencana Aksi</h3>
                                <a href="{{ url()->previous() }}" class="btn btn-primary mt-3 btn-xs"
                                    style="float: right">Kembali</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">

                                    <tbody>
                                        <tr>
                                            <th style="width: 200px">Monitor</th>
                                            <td>{{ $renaksi->kegiatan->monitor->nama_monitor }}</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px">Bidang</th>
                                            <td>Pemerintahan</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px">Kegiatan</th>
                                            <td>{{ $renaksi->kegiatan->nama_kegiatan }}</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px">Rencana Aksi</th>
                                            <td>{{ $renaksi->nama_renaksi }}</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px">Periode</th>
                                            <td>{{ $renaksi->periode }}</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                            <div class="card-header">
                                <h3 class="card-title">Kriteria</h3>

                            </div>
                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        @if (Auth::user()->roles == 'ADMIN')
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="modal"
                                                    data-target="#create-kriteria">(+)</a>
                                            </li>
                                        @endif
                                        @foreach ($renaksi->kriteria as $kriteria)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                                    id="custom-tabs-one-home-tab" data-toggle="pill"
                                                    href="#k{{ $loop->index + 1 }}" role="tab"
                                                    aria-controls="custom-tabs-one-home"
                                                    aria-selected="true">K{{ $loop->index + 1 }}</a>
                                            </li>
                                        @endforeach
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                                href="#custom-tabs-one-profile" role="tab"
                                                aria-controls="custom-tabs-one-profile" aria-selected="false">K2</a>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        @if ($renaksi->kriteria->isNotEmpty())
                                            @foreach ($renaksi->kriteria as $kriteria)
                                                <div class="tab-pane fade {{ $loop->index == 0 ? 'active show' : '' }}"
                                                    id="k{{ $loop->index + 1 }}" role="tabpanel"
                                                    aria-labelledby="custom-tabs-one-home-tab">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <strong><em>Kriteria Keberhasilan</em></strong>&nbsp;&nbsp;
                                                            <i class="fa fa-info-circle text-success log-criteria"
                                                                data-toggle="tooltip" data-placement="right"
                                                                title="Disetujui"
                                                                data-request="PulX1834vwPEhWiI9lAZjCMnhGmgzq9PK8WXLxAa52Q">
                                                            </i>
                                                            <div class="pull-right">
                                                                <div class="btn-group">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="panel-body G4KMeKMKFMWyS_ucPjBgJfUsU1yUYy2KHoYBxTaxSbcpXj1J0vxI7bj9Ql5S8L73bIRasfY0QvrQU9Sycfdx5Q">
                                                            <p>{{ $kriteria->kriteria_keberhasilan }}<br></p>
                                                        </div>
                                                    </div>
                                                    <table data-toggle="table"
                                                        data-classes="table table-hover table-striped"
                                                        data-row-style="rowStyle" class="table table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 30%; " data-field="0">
                                                                    <div class="th-inner ">Penanggung Jawab</div>
                                                                    <div class="fht-cell"></div>
                                                                </th>
                                                                <th style="width: 30%; " data-field="1">
                                                                    <div class="th-inner ">Instansi/Unit Kerja Koordinasi
                                                                    </div>
                                                                    <div class="fht-cell"></div>
                                                                </th>
                                                                <th style="width: 30%; " data-field="1">
                                                                    <div class="th-inner ">Aksi
                                                                    </div>
                                                                    <div class="fht-cell"></div>
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="info" data-index="0">
                                                                <td style="width: 30%; ">{{ $renaksi->skpd->nama_skpd }}
                                                                </td>
                                                                <td style="width: 30%; ">
                                                                    @foreach (json_decode($kriteria->instansi) as $key => $data)
                                                                        {{ App\Skpd::where('id', $data)->first()->nama_skpd }},
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-primary badge" id="edit-kriteria"
                                                                        data-toggle="modal" data-target="#kriteria-edit"
                                                                        data-id="{{ $kriteria->id }}"
                                                                        data-kriteria_keberhasilan="{{ $kriteria->kriteria_keberhasilan }}"
                                                                        data-unit_kerja="{{ $kriteria->instansi }}">Edit</button>
                                                                    <a href="{{ route('admin.renaksi.hapus.kriteria', $kriteria->id) }}"
                                                                        class="btn btn-danger badge"
                                                                        onclick="return confirm('Yakin ?')">Hapus</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="tab-pane fade active show" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-home-tab">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <strong><em>Kriteria Keberhasilan</em></strong>&nbsp;&nbsp;
                                                        <i class="fa fa-info-circle text-success log-criteria"
                                                            data-toggle="tooltip" data-placement="right"
                                                            title="Disetujui"
                                                            data-request="PulX1834vwPEhWiI9lAZjCMnhGmgzq9PK8WXLxAa52Q">
                                                        </i>
                                                        <div class="pull-right">
                                                            <div class="btn-group">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="panel-body G4KMeKMKFMWyS_ucPjBgJfUsU1yUYy2KHoYBxTaxSbcpXj1J0vxI7bj9Ql5S8L73bIRasfY0QvrQU9Sycfdx5Q">
                                                        <p>Belum Tersedia</p>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif


                                    </div>

                                </div>
                            </div>

                            <div class="card-header">
                                <h3 class="card-title">Ukuran</h3>

                            </div>
                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        @if (Auth::user()->roles == 'ADMIN')
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="modal"
                                                    data-target="#create-ukuran">(+)</a>
                                            </li>
                                        @endif
                                        @foreach ($renaksi->masterUkuran as $ukuran)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                                    id="custom-tabs-one-home-tab" data-toggle="pill"
                                                    href="#u{{ $loop->index + 1 }}" role="tab"
                                                    aria-controls="custom-tabs-one-home"
                                                    aria-selected="true">U{{ $loop->index + 1 }}</a>
                                            </li>
                                        @endforeach
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                                href="#custom-tabs-one-profile" role="tab"
                                                aria-controls="custom-tabs-one-profile" aria-selected="false">K2</a>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        @if ($renaksi->masterUkuran->isNotEmpty())
                                            @foreach ($renaksi->masterUkuran as $ukuran)
                                                <div class="tab-pane fade {{ $loop->index == 0 ? 'active show' : '' }}"
                                                    id="u{{ $loop->index + 1 }}" role="tabpanel"
                                                    aria-labelledby="custom-tabs-one-home-tab">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <strong><em>Ukuran Keberhasilan</em></strong>&nbsp;&nbsp;
                                                            <i class="fa fa-info-circle text-success log-criteria"
                                                                data-toggle="tooltip" data-placement="right"
                                                                title="Disetujui"
                                                                data-request="PulX1834vwPEhWiI9lAZjCMnhGmgzq9PK8WXLxAa52Q">
                                                            </i>
                                                            <div class="pull-right">
                                                                <div class="btn-group">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="panel-body G4KMeKMKFMWyS_ucPjBgJfUsU1yUYy2KHoYBxTaxSbcpXj1J0vxI7bj9Ql5S8L73bIRasfY0QvrQU9Sycfdx5Q">
                                                        </div>
                                                    </div>
                                                    <table data-toggle="table"
                                                        data-classes="table table-hover table-striped"
                                                        data-row-style="rowStyle" class="table table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 30%; " data-field="0">
                                                                    <div class="th-inner ">Ukuran Keberhasilan</div>
                                                                    <div class="fht-cell"></div>
                                                                </th>

                                                                <th style="width: 30%; " data-field="1">
                                                                    <div class="th-inner ">Aksi
                                                                    </div>
                                                                    <div class="fht-cell"></div>
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="info" data-index="0">
                                                                <td style="width: 85%; ">
                                                                    {{ $ukuran->ukuran_keberhasilan }}
                                                                </td>

                                                                <td>
                                                                    <button class="btn btn-primary badge" id="edit-ukuran"
                                                                        data-toggle="modal" data-target="#ukuran-edit"
                                                                        data-id="{{ $ukuran->id }}"
                                                                        data-ukuran_keberhasilan="{{ $ukuran->ukuran_keberhasilan }}">Edit</button>
                                                                    <a href="{{ route('admin.renaksi.hapus.ukuran-keberhasilan', $ukuran->id) }}"
                                                                        class="btn btn-danger badge"
                                                                        onclick="return confirm('Yakin ?')">Hapus</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="tab-pane fade active show" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-home-tab">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <strong><em>Ukuran Keberhasilan</em></strong>&nbsp;&nbsp;
                                                        <i class="fa fa-info-circle text-success log-criteria"
                                                            data-toggle="tooltip" data-placement="right"
                                                            title="Disetujui"
                                                            data-request="PulX1834vwPEhWiI9lAZjCMnhGmgzq9PK8WXLxAa52Q">
                                                        </i>
                                                        <div class="pull-right">
                                                            <div class="btn-group">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="panel-body G4KMeKMKFMWyS_ucPjBgJfUsU1yUYy2KHoYBxTaxSbcpXj1J0vxI7bj9Ql5S8L73bIRasfY0QvrQU9Sycfdx5Q">
                                                        <p>Belum Tersedia</p>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif


                                    </div>

                                </div>
                            </div>



                            <div class="card-header">
                                <h3 class="card-title">Target Capaian</h3>

                            </div>
                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                                href="#u1" role="tab" aria-controls="custom-tabs-one-home"
                                                aria-selected="true">T1</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                                    href="#custom-tabs-one-profile" role="tab"
                                                    aria-controls="custom-tabs-one-profile" aria-selected="false">K2</a>
                                            </li> --}}
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade active show" id="u1" role="tabpanel"
                                            aria-labelledby="custom-tabs-one-home-tab">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <strong><em>Target Capaian</em></strong>&nbsp;&nbsp;
                                                    <i class="fa fa-info-circle text-success log-criteria"
                                                        data-toggle="tooltip" data-placement="right" title="Disetujui"
                                                        data-request="PulX1834vwPEhWiI9lAZjCMnhGmgzq9PK8WXLxAa52Q">
                                                    </i>

                                                    <div class="pull-right">
                                                        <div class="btn-group">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="panel-body G4KMeKMKFMWyS_ucPjBgJfUsU1yUYy2KHoYBxTaxSbcpXj1J0vxI7bj9Ql5S8L73bIRasfY0QvrQU9Sycfdx5Q">
                                                    {{-- <p>Persentase penyelesaian penyusunan Dokumen Kinerja tepat waktu<br>
                                                    </p> --}}
                                                </div>
                                                <table data-toggle="table"
                                                data-classes="table table-hover table-striped"
                                                data-row-style="rowStyle" class="table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30%; " data-field="0">
                                                            <div class="th-inner ">Target Capaian</div>
                                                            <div class="fht-cell"></div>
                                                        </th>

                                                        <th style="width: 30%; " data-field="1">
                                                            <div class="th-inner ">Action
                                                            </div>
                                                            <div class="fht-cell"></div>
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="info" data-index="0">
                                                        <td style="width: 85%; ">
                                                            {{ $renaksi->target_capaian ?? 'Belum Tersedia' }}
                                                        </td>

                                                        <td>
                                                            <button class="btn btn-primary badge" id="edit-target-capaian"
                                                                data-toggle="modal" data-target="#target-capaian-edit"
                                                                data-renaksi_id="{{ $renaksi->id }}"
                                                                data-target_capaian="{{ $renaksi->target_capaian }}">Edit</button>
                                                            {{-- <a href="{{ route('admin.renaksi.hapus.ukuran-keberhasilan', $ukuran->id) }}"
                                                                class="btn btn-danger badge"
                                                                onclick="return confirm('Yakin ?')">Hapus</a> --}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                            <div class="table-responsive">
                                                <table data-toggle="table" id="target-table"
                                                    data-classes="table table-hover table-striped table-no-bordered table-responsive"
                                                    data-url="sub-renaksi/show-target?req=G4KMeKMKFMWyS_ucPjBgJfUsU1yUYy2KHoYBxTaxSbd7pVQDqSNyeQt4BcjR67tIm_MMT_rci2dJwR4D8QKmF8JR_Q"
                                                    data-row-style="rowStyle"
                                                    class="table table-hover table-striped table-no-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%; " data-field="checkpoint_names">
                                                                <div class="th-inner ">Periode</div>
                                                                <div class="fht-cell"></div>
                                                            </th>
                                                            <th style="width: 25%; " data-field="name">
                                                                <div class="th-inner ">Tahapan Pencapaian Target</div>
                                                                <div class="fht-cell"></div>
                                                            </th>
                                                            <th style="text-align: center; width: 10%; "
                                                                data-field="capaian">
                                                                <div class="th-inner ">Capaian (%)</div>
                                                                <div class="fht-cell"></div>
                                                            </th>
                                                            <th style="width: 25%; " data-field="description">
                                                                <div class="th-inner ">Keterangan</div>
                                                                <div class="fht-cell"></div>
                                                            </th>
                                                            <th style="width: 25%;" data-field="description">
                                                                <div class="th-inner ">Kendala</div>
                                                                <div class="fht-cell"></div>
                                                            </th>
                                                            <th style="text-align: left; width: 10%; "
                                                                data-field="data_dukung">
                                                                <div class="th-inner">Data Dukung</div>
                                                                <div class="fht-cell"></div>
                                                            </th>
                                                            <th style="text-align: left; width: 20%; "
                                                                data-field="data_dukung">
                                                                <div class="th-inner ">Aksi</div>
                                                                <div class="fht-cell"></div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($renaksi->ukuran as $ukuran)
                                                            <tr data-index="1">
                                                                <td style="width: 10%; ">{{ $ukuran->periode }}</td>
                                                                <td style="width: 35%; ">
                                                                    <p>{{ $ukuran->target_capaian ?? '-' }}<br></p>
                                                                </td>
                                                                <td style="text-align: center; width: 10%; ">
                                                                    <h4><span
                                                                            class="label is-color is-green">{{ $ukuran->capaian ?? 0 }}</span>
                                                                    </h4>
                                                                    {{-- <div class="col-lg-12">
                                                                <div class="btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-default btn-xs target-input-pembahasan-monev-bulanan"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="input pembahasan monev bulanan"
                                                                        data-target="target-input-pembahasan-monev-bulanan">
                                                                        &nbsp;input pembahasan monev bulanan
                                                                    </button>
                                                                    <br>
                                                                    <p></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-default btn-xs target-lihat-pembahasan-monev-bulanan"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="lihat pembahasan monev bulanan"
                                                                        data-target="target-lihat-pembahasan-monev-bulanan">
                                                                        &nbsp;lihat pembahasan monev bulanan
                                                                    </button>
                                                                    <br>
                                                                    <p></p>
                                                                </div>
                                                            </div> --}}
                                                                </td>
                                                                <td style="width: 25%; ">
                                                                    <div class="row">

                                                                        <div class="col-lg-12">
                                                                            {{-- <h4>
                                                                        <span class="label is-color is-red">
                                                                            <i class="fa fa-bullhorn fa-fw"></i>&nbsp;Batas
                                                                            waktu pelaporan sudah berakhir
                                                                        </span>
                                                                    </h4> --}}
                                                                            {{-- <hr> --}}
                                                                            {{-- <strong>Keterangan: </strong> --}}
                                                                            <p>{{ $ukuran->keterangan ?? '-' }} </p>
                                                                            <b>Catatan Verifikator :</b>
                                                                            <p>{{ $ukuran->catatan ?? '-' }}<br> <br>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td style="width: 25%; ">
                                                                    <div class="row">

                                                                        <div class="col-lg-12">
                                                                            {{-- <h4>
                                                                        <span class="label is-color is-red">
                                                                            <i class="fa fa-bullhorn fa-fw"></i>&nbsp;Batas
                                                                            waktu pelaporan sudah berakhir
                                                                        </span>
                                                                    </h4> --}}
                                                                            {{-- <hr> --}}
                                                                            {{-- <b>Catatan Verifikator :</b> --}}
                                                                            <p>{{ $ukuran->kendala ?? '-' }}<br> <br>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td style="text-align: left; width: 10%; ">
                                                                    <ul class="fa-ul">
                                                                        @php
                                                                            $file_pendukung = json_decode($ukuran->file_pendukung);
                                                                        @endphp
                                                                        @if (isset($file_pendukung))
                                                                            @foreach ($file_pendukung as $data)
                                                                                <li>
                                                                                    <small>
                                                                                        <span class="fa-li">
                                                                                            <a href="javascript:void(0);"
                                                                                                class="text-danger hapus-lampiran"
                                                                                                data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                data-target="jRW2BdpPbhtBsdVqy5efJ4AjZ8P2xNhDkkuayJO_9Og"
                                                                                                data-original-title="Hapus MATRIKS CASCADING KINERJA ESELON 2, 3 DAN 4 BKD PROVINSI DKI JAKARTA TAHUN 2022.pdf">
                                                                                                <i class="fa fa-times"></i>
                                                                                            </a>
                                                                                        </span>
                                                                                        <a href="{{ asset($data) }}"
                                                                                            style="
                                                                                           max-width: 100px;
                                                                                            display: block;
                                                                                            white-space: nowrap;
                                                                                            text-overflow: ellipsis;
                                                                                            overflow: hidden;"
                                                                                            class="text-muted"
                                                                                            target="_blank"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            data-original-title="Lihat MATRIKS CASCADING KINERJA ESELON 2, 3 DAN 4 BKD PROVINSI DKI JAKARTA TAHUN 2022.pdf">
                                                                                            {{ $data }}
                                                                                        </a>
                                                                                    </small>
                                                                                </li>
                                                                            @endforeach
                                                                        @else
                                                                            Belum Tersedia
                                                                        @endif
                                                                    </ul>
                                                                </td>
                                                                <td>
                                                                    @if (Auth::user()->roles == 'ADMIN')
                                                                        <a href="{{ route('admin.renaksi.ukuran.detail', $ukuran->id) }}"
                                                                            class="btn btn-primary badge">Detail</a>
                                                                    @else
                                                                        <a href="{{ route('renaksi.ukuran.detail', $ukuran->id) }}"
                                                                            class="btn btn-primary badge">Update</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>


                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

    <div class="modal fade" id="create-kriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.renaksi.store.kriteria') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="renaksi_id" value="{{ $renaksi->id }}">
                                <label for="exampleInputEmail1">Kriteria Keberhasilan</label>
                                <textarea name="kriteria_keberhasilan" class="form-control" placeholder="Masukan Kriteria Keberhasilan" required></textarea>

                            </div>

                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Instansi Unit Kerja</label>
                                <select name="skpd_id" class="form-control" required>
                                    <option value="">Pilih Instansi Unit Kerja</option>
                                    @foreach (App\Skpd::all() as $skpd)
                                        <option value="{{ $skpd->id }}">{{ $skpd->nama_skpd }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label>Instansi Unit Kerja</label>
                                <select class="select2" name="unit_kerja[]" multiple="multiple"
                                    data-placeholder="Pilih Instansi Unit Kerja" style="width: 100%;">
                                    @foreach (App\Skpd::all() as $skpd)
                                        <option value="{{ $skpd->id }}">{{ $skpd->nama_skpd }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="kriteria-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" id="form-edit-kriteria" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="renaksi_id" value="{{ $renaksi->id }}">
                                <label for="exampleInputEmail1">Kriteria Keberhasilan</label>
                                <textarea name="kriteria_keberhasilan" id="kriteria_keberhasilan" class="form-control"
                                    placeholder="Masukan Kriteria Keberhasilan" required></textarea>

                            </div>

                            {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Instansi Unit Kerja</label>
                            <select name="skpd_id" class="form-control" required>
                                <option value="">Pilih Instansi Unit Kerja</option>
                                @foreach (App\Skpd::all() as $skpd)
                                    <option value="{{ $skpd->id }}">{{ $skpd->nama_skpd }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                            <div class="form-group">
                                <label>Instansi Unit Kerja</label>
                                <select class="select2" name="unit_kerja[]" multiple="multiple"
                                    data-placeholder="Pilih Instansi Unit Kerja" id="unit_kerja" style="width: 100%;">
                                    @foreach (App\Skpd::all() as $skpd)
                                        <option value="{{ $skpd->id }}">{{ $skpd->nama_skpd }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="create-ukuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ukuran Keberhasilan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.renaksi.store.ukuran-keberhasilan') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="renaksi_id" value="{{ $renaksi->id }}">
                                <label for="exampleInputEmail1">Ukuran Keberhasilan</label>
                                <textarea name="ukuran_keberhasilan" class="form-control" placeholder="Masukan Ukuran Keberhasilan" required></textarea>

                            </div>



                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="ukuran-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Ukuran Keberhasilan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data" id="form-edit-ukuran">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="renaksi_id" value="{{ $renaksi->id }}">
                                <label for="exampleInputEmail1">Ukuran Keberhasilan</label>
                                <textarea name="ukuran_keberhasilan" id="ukuran_keberhasilan" class="form-control"
                                    placeholder="Masukan Ukuran Keberhasilan" required></textarea>

                            </div>



                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="ukuran-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Ukuran Keberhasilan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data" id="form-edit-ukuran">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="renaksi_id" value="{{ $renaksi->id }}">
                                <label for="exampleInputEmail1">Ukuran Keberhasilan</label>
                                <textarea name="ukuran_keberhasilan" id="ukuran_keberhasilan" class="form-control"
                                    placeholder="Masukan Ukuran Keberhasilan" required></textarea>

                            </div>



                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="target-capaian-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Target Capaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" enctype="multipart/form-data" id="form-edit-target-capaian">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" name="renaksi_id" value="{{ $renaksi->id }}">
                            <label for="exampleInputEmail1">Target Capaian</label>
                            <textarea name="target_capaian" id="target_capaian" class="form-control"
                                placeholder="Masukan Target Capaian" required></textarea>

                        </div>



                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
            </form>

        </div>
    </div>
</div>
    @push('down-script')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#edit-kriteria', function() {
                    var id = $(this).data('id');
                    var kriteria_keberhasilan = $(this).data('kriteria_keberhasilan');
                    var unit_kerja = $(this).data('unit_kerja').toString();

                    $.each(unit_kerja.split(","), function(i, e) {
                        $("#unit_kerja option[value='" + e + "']").prop("selected", true);
                    });

                    $('#kriteria_keberhasilan').val(kriteria_keberhasilan);

                    $('#form-edit-kriteria').attr('action', '/admin/renaksi/update/kriteria/' + id);
                });

                $(document).on('click', '#edit-ukuran', function() {
                    var id = $(this).data('id');
                    var ukuran_keberhasilan = $(this).data('ukuran_keberhasilan');

                    $('#ukuran_keberhasilan').val(ukuran_keberhasilan);

                    $('#form-edit-ukuran').attr('action', '/admin/renaksi/update/ukuran-keberhasilan/' + id);
                });

                $(document).on('click', '#edit-target-capaian', function() {
                    var id = $(this).data('renaksi_id');
                    var target_capaian = $(this).data('target_capaian');

                    $('#target_capaian').val(target_capaian);

                    $('#form-edit-target-capaian').attr('action', '/admin/renaksi/update/target-capaian/' + id);
                });



            });
        </script>
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2();

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

            });
        </script>
    @endpush
@endsection
