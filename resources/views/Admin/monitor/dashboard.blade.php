@extends('layouts.dashboard-admin')

@section('title', 'Halaman Renaksi')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $monitor->nama_monitor }}</h1>
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



                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                            href="#B03" role="tab" aria-controls="custom-tabs-b03"
                                            aria-selected="true">B03</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                            href="#B06" role="tab" aria-controls="custom-tabs-b03"
                                            aria-selected="false">B06</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                            href="#B09" role="tab" aria-controls="custom-tabs-one-profile"
                                            aria-selected="false">B09</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                            href="#B12" role="tab" aria-controls="custom-tabs-one-profile"
                                            aria-selected="false">B12</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade active show" id="B03" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Statistik</h3>

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-center" style="font-size: 30px">Maret
                                                            {{ $monitor->tahun }}</div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table" style="border: none">
                                                                    <tr>
                                                                        <td>Target Tercapai</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TERCAPAI', 'B03']) }}">{{ $targetTercapaiB03 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tercapai (perbaikan)</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'PERBAIKAN', 'B03']) }}">{{ $perbaikanB03 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Sempurna</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK SEMPURNA', 'B03']) }}">{{ $tidakSempurnaB03 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Tercapai</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK TERCAPAI', 'B03']) }}">{{ $tidakTercapaiB03 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Verifikasi</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'VERIFIKASI', 'B03']) }}">{{ $verifikasiB03 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tidak Lapor</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK LAPOR', 'B03']) }}">{{ $tidakLaporB03 }}</a>
                                                                        </td>
                                                                    </tr>

                                                                </table>
                                                                <div class="text-right">TOTAL {{ $totalB03 }} Renaksi
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Grafik</h3>


                                                    </div>
                                                    <div class="card-body">
                                                        <canvas id="donutChartb03"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="B06" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Statistik</h3>


                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-center" style="font-size: 30px">Juni
                                                            {{ $monitor->tahun }}</div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table" style="border: none">
                                                                    <tr>
                                                                        <td>Target Tercapai</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TERCAPAI', 'B06']) }}">{{ $targetTercapaiB06 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tercapai (perbaikan)</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'PERBAIKAN', 'B06']) }}">{{ $perbaikanB06 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Sempurna</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK SEMPURNA', 'B06']) }}">{{ $tidakSempurnaB06 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Tercapai</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK TERCAPAI', 'B06']) }}">{{ $tidakTercapaiB06 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Verifikasi</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'VERIFIKASI', 'B06']) }}">{{ $verifikasiB06 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tidak Lapor</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK LAPOR', 'B06']) }}">{{ $tidakLaporB06 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <div class="text-right">TOTAL {{ $totalB06 }} Renaksi
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Grafik</h3>


                                                    </div>
                                                    <div class="card-body">
                                                        <canvas id="donutChartb06"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="B09" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Statistik</h3>

                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-center" style="font-size: 30px">September
                                                            {{ $monitor->tahun }}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table" style="border: none">
                                                                    <tr>
                                                                        <td>Target Tercapai</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TERCAPAI', 'B09']) }}">{{ $targetTercapaiB09 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tercapai (perbaikan)</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'PERBAIKAN', 'B09']) }}">{{ $perbaikanB09 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Sempurna</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK SEMPURNA', 'B09']) }}">{{ $tidakSempurnaB09 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Tercapai</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK TERCAPAI', 'B09']) }}">{{ $tidakTercapaiB09 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Verifikasi</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'VERIFIKASI', 'B09']) }}">{{ $verifikasiB09 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tidak Lapor</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK LAPOR', 'B09']) }}">{{ $tidakLaporB09 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <div class="text-right">TOTAL {{ $totalB09 }} Renaksi
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Grafik</h3>


                                                    </div>
                                                    <div class="card-body">
                                                        <canvas id="donutChartb09"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="B12" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Statistik</h3>


                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-center" style="font-size: 30px">Desember
                                                            {{ $monitor->tahun }}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table" style="border: none">
                                                                    <tr>
                                                                        <td>Target Tercapai</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TERCAPAI', 'B12']) }}">{{ $targetTercapaiB12 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tercapai (perbaikan)</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'PERBAIKAN', 'B12']) }}">{{ $perbaikanB12 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Sempurna</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK SEMPURNA', 'B12']) }}">{{ $tidakSempurnaB12 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Tercapai</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK TERCAPAI', 'B12']) }}">{{ $tidakTercapaiB12 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Verifikasi</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'VERIFIKASI', 'B12']) }}">{{ $verifikasiB12 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tidak Lapor</td>
                                                                        <td class="text-right">
                                                                            <a
                                                                                href="{{ route('admin.renaksi.status.index', [$monitor->id, 'TIDAK LAPOR', 'B12']) }}">{{ $tidakLaporB12 }}</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <div class="text-right">TOTAL {{ $totalB12 }} Renaksi
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Grafik</h3>


                                                    </div>
                                                    <div class="card-body">
                                                        <canvas id="donutChartb12"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
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
@endsection

@push('down-script')
    <script>
        $(function() {

            var targetTercapaiB03 = '{{ $targetTercapaiB03 }}';
            var perbaikanB03 = '{{ $perbaikanB03 }}';
            var tidakSempurnaB03 = '{{ $tidakSempurnaB03 }}';
            var tidakTercapaiB03 = '{{ $tidakTercapaiB03 }}';
            var verifikasiB03 = '{{ $verifikasiB03 }}';
            var tidakLaporB03 = '{{ $tidakLaporB03 }}';
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChartb03').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Target Tercapai',
                    'Target Tercapai (perbaikan)',
                    'Target Tidak Sempurna',
                    'Target Tidak Tercapai',
                    'Verifikasi',
                    'Tidak Lapor',
                ],
                datasets: [{
                    data: [targetTercapaiB03, perbaikanB03, tidakSempurnaB03, tidakTercapaiB03,
                        verifikasiB03, tidakLaporB03
                    ],
                    backgroundColor: ['#1FAA00', '#9CFF57', '#F0AD4E', '#CB2027', '#999999', '#2B2B2B'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            var targetTercapaiB06 = '{{ $targetTercapaiB06 }}';
            var perbaikanB06 = '{{ $perbaikanB06 }}';
            var tidakSempurnaB06 = '{{ $tidakSempurnaB06 }}';
            var tidakTercapaiB06 = '{{ $tidakTercapaiB06 }}';
            var verifikasiB06 = '{{ $verifikasiB06 }}';
            var tidakLaporB06 = '{{ $tidakLaporB06 }}';

            var donutChartCanvas = $('#donutChartb06').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Target Tercapai',
                    'Target Tercapai (perbaikan)',
                    'Target Tidak Sempurna',
                    'Target Tidak Tercapai',
                    'Verifikasi',
                    'Tidak Lapor',
                ],
                datasets: [{
                    data: [targetTercapaiB06, perbaikanB06, tidakSempurnaB06, tidakTercapaiB06,
                        verifikasiB06, tidakLaporB06
                    ],

                    backgroundColor: ['#1FAA00', '#9CFF57', '#F0AD4E', '#CB2027', '#999999', '#2B2B2B'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            var targetTercapaiB09 = '{{ $targetTercapaiB09 }}';
            var perbaikanB09 = '{{ $perbaikanB09 }}';
            var tidakSempurnaB09 = '{{ $tidakSempurnaB09 }}';
            var tidakTercapaiB09 = '{{ $tidakTercapaiB09 }}';
            var verifikasiB09 = '{{ $verifikasiB09 }}';
            var tidakLaporB09 = '{{ $tidakLaporB09 }}';


            var donutChartCanvas = $('#donutChartb09').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Target Tercapai',
                    'Target Tercapai (perbaikan)',
                    'Target Tidak Sempurna',
                    'Target Tidak Tercapai',
                    'Verifikasi',
                    'Tidak Lapor',
                ],
                datasets: [{
                    data: [targetTercapaiB09, perbaikanB09, tidakSempurnaB09, tidakTercapaiB09,
                        verifikasiB09, tidakLaporB09
                    ],
                    backgroundColor: ['#1FAA00', '#9CFF57', '#F0AD4E', '#CB2027', '#999999', '#2B2B2B'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })


            var targetTercapaiB12 = '{{ $targetTercapaiB12 }}';
            var perbaikanB12 = '{{ $perbaikanB12 }}';
            var tidakSempurnaB12 = '{{ $tidakSempurnaB12 }}';
            var tidakTercapaiB12 = '{{ $tidakTercapaiB12 }}';
            var verifikasiB12 = '{{ $verifikasiB12 }}';
            var tidakLaporB12 = '{{ $tidakLaporB12 }}';


            var donutChartCanvas = $('#donutChartb12').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Target Tercapai',
                    'Target Tercapai (perbaikan)',
                    'Target Tidak Sempurna',
                    'Target Tidak Tercapai',
                    'Verifikasi',
                    'Tidak Lapor',
                ],
                datasets: [{
                    data: [targetTercapaiB12, perbaikanB12, tidakSempurnaB12, tidakTercapaiB12,
                        verifikasiB12, tidakLaporB12
                    ],
                    backgroundColor: ['#1FAA00', '#9CFF57', '#F0AD4E', '#CB2027', '#999999', '#2B2B2B'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

        })
    </script>
@endpush
