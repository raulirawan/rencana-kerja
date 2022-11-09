@extends('layouts.dashboard-admin')

@section('title', 'Halaman Monitor')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Monitor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Monitor</li>
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
                                <h3 class="card-title">Data Monitor</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    (+) Tambah Monitor
                                </button>

                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Nama Monitor</th>
                                                <th>Verifikator</th>
                                                <th>Pemantau</th>
                                                <th style="width: 15%">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($monitor as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_monitor }}</td>
                                                    <td>{{ $item->verifikator }}</td>
                                                    <td>{{ $item->pemantau }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.kegiatan.index', $item->id) }}"
                                                            class="btn btn-sm btn-info badge mt-1 mr-1"
                                                            style='float: left;'>Detail</a>
                                                        <a href="{{ route('admin.monitor.dashboard', $item->id) }}"
                                                            class="btn btn-sm btn-success badge mt-1 mr-1"
                                                            style='float: left;'>Dashboard</a>
                                                        <button type="button" id="edit" data-toggle="modal"
                                                            data-target="#modal-edit" data-id="{{ $item->id }}"
                                                            data-nama_monitor="{{ $item->nama_monitor }}"
                                                            data-verifikator="{{ $item->verifikator }}"
                                                            data-pemantau="{{ $item->pemantau }}"
                                                            data-tahun="{{ $item->tahun }}"
                                                            class="btn btn-sm btn-primary badge mt-1"
                                                            style='float: left;'>Edit</button>
                                                        <form action="{{ route('admin.monitor.delete', $item->id) }}"
                                                            method="POST" style='float: left; padding-left: 5px;'>
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger badge"
                                                                onclick="return confirm('Yakin ?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Monitor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.monitor.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Monitor</label>
                                <input type="text" class="form-control" value="{{ old('nama_project') }}"
                                    name="nama_monitor" placeholder="Masukan Nama Project" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Verifikator</label>
                                <textarea name="verifikator" class="form-control" required placeholder="Masukan Monitor"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pemantau</label>
                                <textarea name="pemantau" class="form-control" required placeholder="Masukan Pemantau"></textarea>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input type="number" max="4" min="4" class="form-control"
                                    value="{{ old('tahun') }}" name="tahun" placeholder="Masukan Tahun" required>
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


    <!-- Modal Edit -->
    <div class="modal fade modal-edit" id="modal-edit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Monitor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Monitor</label>
                                <input type="text" class="form-control" value="{{ old('nama_monitor') }}"
                                    name="nama_monitor" id="nama_monitor" placeholder="Masukan Nama Project" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Verifikator</label>
                                <textarea name="verifikator" id="verifikator" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pemantau</label>
                                <textarea name="pemantau" id="pemantau" class="form-control" required></textarea>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input type="number" max="4" min="4" class="form-control"
                                    value="{{ old('tahun') }}" id="tahun" name="tahun"
                                    placeholder="Masukan Tahun" required>
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



@endsection

@push('down-script')
    @if (count($errors) > 0)
        <script type="text/javascript">
            $(document).ready(function() {
                $('#exampleModal').modal('show');
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#modal-edit').modal('show');
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                var nama_monitor = $(this).data('nama_monitor');
                var verifikator = $(this).data('verifikator');
                var pemantau = $(this).data('pemantau');
                var tahun = $(this).data('tahun');

                $('#nama_monitor').val(nama_monitor);
                $('#verifikator').val(verifikator);
                $('#pemantau').val(pemantau);
                $('#tahun').val(tahun);

                $('#form-edit').attr('action', '/admin/monitor/update/' + id);
            });
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
