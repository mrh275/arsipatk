@extends('templates.admin-layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Master</a></li>
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Permintaan</th>
                                            <th>Issued by</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Permintaan</th>
                                            <th>Satuan</th>
                                            <th>Tanggal Permintaan</th>
                                            <th>Status Permintaan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPermintaan as $permintaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $permintaan->id_permintaan }}</td>
                                                <td>{{ $permintaan->issued_by }}</td>
                                                <td>{{ $permintaan->barang->nama_barang }}</td>
                                                <td>{{ $permintaan->jumlah_permintaan }}</td>
                                                <td>{{ $permintaan->barang->satuan_barang }}</td>
                                                <td>{{ $permintaan->tanggal_permintaan }}</td>
                                                <td>{{ $permintaan->status_permintaan }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a>
                                                    <a href="{{ url('admin/transaksi/hapus') . '/' . $permintaan->id_permintaan }}" class="btn btn-danger btn-sm">
                                                        Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                    text: '<i class="fas fa-plus"></i> Tambah Permintaan',
                    className: 'btn-primary',
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    },
                    action: function(e, dt, node, config) {
                        window.location.href = "{{ url('admin/transaksi/tambah-permintaan') }}";
                    }
                }]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $(document).ready(function() {
            $('#example1').on('click', '.btn-danger', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Hapus Permintaan',
                    text: "Apakah Anda yakin ingin menghapus data permintaan ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endpush
