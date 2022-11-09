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

                        <!-- /.card -->
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                            href="#k1" role="tab" aria-controls="custom-tabs-one-home"
                                            aria-selected="true">K1</a>
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
                                    <div class="tab-pane fade active show" id="k1" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Statistik</h3>


                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-center" style="font-size: 30px">Maret 2021</div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table" style="border: none">
                                                                    <tr>
                                                                        <td>Target Tercapai</td>
                                                                        <td class="text-right">0</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tercapai (perbaikan)</td>
                                                                        <td class="text-right">0</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Sempurna</td>
                                                                        <td class="text-right">0</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Target Tidak Tercapai</td>
                                                                        <td class="text-right">0</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Verifikasi</td>
                                                                        <td class="text-right">0</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tidak Lapor</td>
                                                                        <td class="text-right">0</td>
                                                                    </tr>

                                                                </table>
                                                                <div class="text-right">TOTAL 301 Renaksi</div>
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
                                                        <canvas id="donutChart"
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

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Chrome',
                    'IE',
                    'FireFox',
                    'Safari',
                    'Opera',
                    'Navigator',
                ],
                datasets: [{
                    data: [700, 500, 400, 600, 300, 100],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
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
