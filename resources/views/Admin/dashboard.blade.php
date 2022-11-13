@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <div class="text-muted">Data Statistik di Bawah Ini Merupakan Data Pada Tanggal</div> --}}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-6 col">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ App\Skpd::count() }}</h3>

                                <p>Total SKPD</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <b class="inner">
                                <h3>{{ App\Renaksi::count() }}</h3>

                                <p>Total Rencana Kerja</p>
                            </b>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                </div>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </section>
        <!-- /.content -->
    </div>
@endsection
