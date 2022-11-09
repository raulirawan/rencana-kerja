@extends('layouts.dashboard-admin')

@section('title', 'Halaman Ukuran')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ukuran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Ukuran</li>
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
                                <h3 class="card-title">Detail Ukuran Keberhasilan {{ $ukuran->periode }} <br> {{ $ukuran->renaksi->nama_renaksi }}</h3>
                                <a href="{{ url()->previous() }}" class="btn btn-primary mt-3 btn-xs"
                                    style="float: right">Kembali</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.renaksi.ukuran.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="hidden" value="{{ $ukuran->id }}" name="ukuran_id">
                                            <label for="exampleInputEmail1">Catatan</label>
                                            <textarea name="catatan" id="catatan" required class="form-control" placeholder="Masukan Catatan"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

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
    @push('down-script')
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
