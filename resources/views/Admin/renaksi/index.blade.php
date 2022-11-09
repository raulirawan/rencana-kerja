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
                                <h3 class="card-title">Data Renaksi</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (Auth::user()->roles == 'ADMIN')
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        (+) Tambah Renaksi
                                    </button>
                                @endif
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Kode</th>
                                                <th>Nama Renaksi</th>
                                                <th>Penanggung Jawab</th>
                                                <th style="width: 15%">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($renaksi as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->kode }}</td>
                                                    <td>{{ $item->nama_renaksi }}</td>
                                                    <td>{{ $item->skpd->nama_skpd }}</td>
                                                    <td>
                                                        @if (Auth::user()->roles == 'ADMIN')
                                                            <a href="{{ route('admin.renaksi.detail', $item->id) }}"
                                                                class="btn btn-sm btn-info badge mt-1 mr-1"
                                                                style='float: left;'>Detail</a>
                                                            <button type="button" id="edit" data-toggle="modal"
                                                                data-target="#modal-edit" data-id="{{ $item->id }}"
                                                                data-nama_renaksi="{{ $item->nama_renaksi }}"
                                                                data-skpd="{{ $item->skpd->id }}"
                                                                data-periode="{{ $item->periode }}"
                                                                class="btn btn-sm btn-primary badge mt-1"
                                                                style='float: left;'>Edit</button>
                                                            <form action="{{ route('admin.renaksi.delete', $item->id) }}"
                                                                method="POST" style='float: left; padding-left: 5px;'>
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger badge"
                                                                    onclick="return confirm('Yakin ?')">Hapus</button>
                                                            </form>
                                                        @else
                                                            <a href="{{ route('renaksi.detail', $item->id) }}"
                                                                class="btn btn-sm btn-info badge mt-1 mr-1"
                                                                style='float: left;'>Detail</a>
                                                        @endif
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Renaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.renaksi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="kegiatan_id" value="{{ $kegiatan_id }}">
                                <label for="exampleInputEmail1">Nama Renaksi</label>
                                <textarea name="nama_renaksi" class="form-control" placeholder="Masukan Nama Renaksi" required></textarea>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Penanggung Jawab</label>
                                <select name="skpd_id" class="form-control" required>
                                    <option value="">Pilih Penanggung Jawab</option>
                                    @foreach (App\Skpd::all() as $skpd)
                                        <option value="{{ $skpd->id }}">{{ $skpd->nama_skpd }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Periode</label>
                                <select name="periode" class="form-control" required>
                                    <option value="">Pilih Periode</option>
                                    <option value="B03">B03</option>
                                    <option value="B06">B06</option>
                                    <option value="B09">B09</option>
                                    <option value="B12">B12</option>
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


    <!-- Modal Edit -->
    <div class="modal fade modal-edit" id="modal-edit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Renaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="kegiatan_id" value="{{ $kegiatan_id }}">
                                <label for="exampleInputEmail1">Nama Renaksi</label>
                                <textarea name="nama_renaksi" id="nama_renaksi" class="form-control" placeholder="Masukan Nama Renaksi" required></textarea>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Penanggung Jawab</label>
                                <select name="skpd_id" id="skpd_id" class="form-control" required>
                                    <option value="">Pilih Penanggung Jawab</option>
                                    @foreach (App\Skpd::all() as $skpd)
                                        <option value="{{ $skpd->id }}">{{ $skpd->nama_skpd }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Periode</label>
                                <select name="periode" id="periode" class="form-control" required>
                                    <option value="">Pilih Periode</option>
                                    <option value="B03">B03</option>
                                    <option value="B06">B06</option>
                                    <option value="B09">B09</option>
                                    <option value="B12">B12</option>
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
                var nama_renaksi = $(this).data('nama_renaksi');
                var periode = $(this).data('periode');
                var skpd_id = $(this).data('skpd');


                $('#nama_renaksi').val(nama_renaksi);
                $('#periode').val(periode);
                $('#skpd_id').val(skpd_id);

                $('#form-edit').attr('action', '/admin/renaksi/update/' + id);
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
