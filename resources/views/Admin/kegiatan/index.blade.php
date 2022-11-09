@extends('layouts.dashboard-admin')

@section('title', 'Halaman Kegiatan')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kegiatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kegiatan</li>
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
                                <h3 class="card-title">Data Kegiatan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    (+) Tambah Kegiatan
                                </button>

                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Kategori</th>
                                                <th>Sasaran Strategis</th>
                                                <th>Periode Awal</th>
                                                <th>Periode Akhir</th>
                                                <th style="width: 15%">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kegiatan as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_kegiatan }}</td>
                                                    <td>{{ $item->kategori }}</td>
                                                    <td>{{ $item->sasaranStrategis->nama_sasaran }}</td>
                                                    <td>{{ $item->periode_awal ?? '-' }}</td>
                                                    <td>{{ $item->periode_akhir ?? '-' }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.renaksi.index', $item->id) }}"
                                                            class="btn btn-sm btn-info badge mt-1 mr-1"
                                                            style='float: left;'>Detail</a>
                                                        <button type="button" id="edit" data-toggle="modal"
                                                            data-target="#modal-edit" data-id="{{ $item->id }}"
                                                            data-nama_kegiatan="{{ $item->nama_kegiatan }}"
                                                            data-kategori="{{ $item->kategori }}"
                                                            data-sasaran_strategis="{{ $item->sasaranStrategis->id }}"
                                                            data-periode_awal="{{ $item->periode_awal }}"
                                                            data-periode_akhir="{{ $item->periode_akhir }}"
                                                            class="btn btn-sm btn-primary badge mt-1"
                                                            style='float: left;'>Edit</button>
                                                        <form action="{{ route('admin.kegiatan.delete', $item->id) }}"
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.kegiatan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="monitor_id" value="{{ $monitor_id }}">
                                <label for="exampleInputEmail1">Nama Kegiatan</label>
                                <textarea name="nama_kegiatan" class="form-control" placeholder="Masukan Nama Kegiatan" required></textarea>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori</label>
                                <input type="text" class="form-control" value="{{ old('kategori') }}" name="kategori"
                                    placeholder="Masukan Nama Kategori" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sasaran Strategis</label>
                                <select name="sasaran_id" class="form-control" required>
                                    <option value="">Pilih Sasaran</option>
                                    @foreach (App\SasaranStrategis::all() as $sasaran)
                                        <option value="{{ $sasaran->id }}">{{ $sasaran->nama_sasaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Periode Awal</label>
                                <input type="date" name="periode_awal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Periode Akhir</label>
                                <input type="date" name="periode_akhir" class="form-control">

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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="monitor_id" value="{{ $monitor_id }}">
                                <label for="exampleInputEmail1">Nama Kegiatan</label>
                                <textarea name="nama_kegiatan" id="nama_kegiatan" class="form-control" placeholder="Masukan Nama Kegiatan" required></textarea>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Kategori</label>
                                <input type="text" class="form-control" value="{{ old('kategori') }}"
                                    name="kategori" id="kategori" placeholder="Masukan Kategori" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sasaran Strategis</label>
                                <select name="sasaran_id" id="sasaran_id" class="form-control" required>
                                    <option value="">Pilih Sasaran</option>
                                    @foreach (App\SasaranStrategis::all() as $sasaran)
                                        <option value="{{ $sasaran->id }}">{{ $sasaran->nama_sasaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Periode Awal</label>
                                <input type="date" id="periode_awal" name="periode_awal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Periode Akhir</label>
                                <input type="date" id="periode_akhir" name="periode_akhir" class="form-control">

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
                var nama_kegiatan = $(this).data('nama_kegiatan');
                var kategori = $(this).data('kategori');
                var sasaran_id = $(this).data('sasaran_strategis');
                var periode_awal = $(this).data('periode_awal');
                var periode_akhir = $(this).data('periode_akhir');


                $('#nama_kegiatan').val(nama_kegiatan);
                $('#kategori').val(kategori);
                $('#sasaran_id').val(sasaran_id);
                $('#periode_awal').val(periode_awal);
                $('#periode_akhir').val(periode_akhir);

                $('#form-edit').attr('action', '/admin/kegiatan/update/' + id);
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
