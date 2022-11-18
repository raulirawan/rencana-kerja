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
                                <h3 class="card-title">Detail Ukuran Keberhasilan {{ $ukuran->periode }} <br>
                                    {{ $ukuran->renaksi->nama_renaksi }}</h3>
                                <a href="{{ url()->previous() }}" class="btn btn-primary mt-3 btn-xs"
                                    style="float: right">Kembali</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('renaksi.ukuran.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <input type="hidden" value="{{ $ukuran->id }}" name="ukuran_id">
                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Target Capaian</label>
                                            <textarea name="target_capaian" id="target_capaian" required class="form-control" placeholder="Masukan Target Capaian">{{ $ukuran->target_capaian }}</textarea>
                                        </div> --}}

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Capaian</label>
                                            <select name="capaian" id="capaian" class="form-control">
                                                @for ($i = 1; $i <= 100; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $ukuran->capaian == $i ? 'selected' : '' }}>{{ $i }}
                                                        %</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" required class="form-control" placeholder="Masukan Keterangan">{{ $ukuran->keterangan }}</textarea>
                                        </div>


                                        <div class="mb-4">
                                            <label class="form-label">File Dukung</label>
                                            <input type="file" name="file_pendukung[]" class="form-control" multiple>
                                            @if ($errors->has('file_pendukung.*'))
                                                <span class="text-danger">{{ $errors->first('file_pendukung.*') }}</span>
                                            @endif
                                        </div>

                                        @if ($ukuran->file_pendukung != null)
                                            @php
                                                $files = json_decode($ukuran->file_pendukung);
                                            @endphp
                                            <div class="row">
                                                @foreach ($files as $key => $file)
                                                    <div class="col-4">
                                                        <div class="gallery-container">
                                                            <a href="{{ asset($file) }}" target="_blank" alt=""
                                                                class="w-100">
                                                                {{ $file }}
                                                            </a>
                                                            <div class="text-center">
                                                                <a href="{{ route('ukuran.delete.file', [$ukuran->id, $key]) }}"
                                                                    class="btn btn-sm btn-danger btn-block" onclick="return confirm('Yakin ?')">
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif


                                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
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
