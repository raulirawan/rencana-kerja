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
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Kode</th>
                                                <th>Nama Renaksi</th>
                                                <th>Penanggung Jawab</th>
                                                <th>Capai</th>
                                                <th>Status</th>
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
                                                        @if ($item->capaian == 100)
                                                            <span class="badge" style="background: #1FAA00; color: #fff">
                                                                {{ $item->capaian }} %
                                                            </span>
                                                        @elseif ($item->capaian == 80)
                                                            <span class="badge" style="background: #9CFF57; color: #fff">
                                                                {{ $item->capaian }} %
                                                            </span>
                                                        @elseif ($item->capaian == 60)
                                                            <span class="badge" style="background: #F0AD4E; color: #fff">
                                                                {{ $item->capaian }} %
                                                            </span>
                                                        @elseif ($item->capaian == 40)
                                                            <span class="badge" style="background: #CB2027; color: #fff">
                                                                {{ $item->capaian }} %
                                                            </span>
                                                        @elseif ($item->capaian == 20)
                                                            <span class="badge" style="background: #999999; color: #fff">
                                                                {{ $item->capaian }} %
                                                            </span>
                                                        @else
                                                            <span class="badge" style="background: #2B2B2B; color: #fff">
                                                                {{ $item->capaian }} %
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $item->status }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.renaksi.detail', $item->id) }}"
                                                            class="btn btn-sm btn-info badge mt-1 mr-1"
                                                            style='float: left;'>Detail</a>
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
