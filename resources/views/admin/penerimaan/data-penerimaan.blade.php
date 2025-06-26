@extends('templates.admin-layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Penerimaan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                            <li class="breadcrumb-item active">Penerimaan</li>
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
                                            <th>ID Penerimaan</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Tanggal Penerimaan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPenerimaan as $penerimaan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $penerimaan->id_penerimaan }}</td>
                                                <td>{{ $penerimaan->barang->nama_barang }}</td>
                                                <td>{{ $penerimaan->jumlah }}</td>
                                                <td>{{ $penerimaan->barang->satuan_barang }}</td>
                                                <td>{{ $penerimaan->tanggal_penerimaan }}</td>
                                                <td>
                                                    <button type="button" value="{{ $penerimaan->id_penerimaan }}" id="editDataPenerimaan" class="btn btn-warning btn-sm">
                                                        Edit
                                                    </button>
                                                    {{-- <a href="{{ url('admin/transaksi/get-penerimaan') . '/' . $penerimaan->id_penerimaan }}" id="editDataPenerimaan" class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a> --}}
                                                    <a href="{{ url('admin/transaksi/penerimaan/hapus') . '/' . $penerimaan->id_penerimaan }}" class="btn btn-danger btn-sm">
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

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <form action="{{ url('admin/transaksi/update-penerimaan') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Default Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="id_penerimaan">ID Penerimaan</label>
                            <input type="hidden" class="form-control" id="id_penerimaan" name="id_penerimaan" required>
                            <input type="text" class="form-control" id="id_penerimaan_preview" name="id_penerimaan_preview" disabled="disabled" required>
                        </div>
                        <div class="form-group">
                            <label for="barang_id">Barang</label>
                            <select class="form-control" id="barang_id" name="id_barang" required>
                                <option value="">Pilih Barang</option>
                                @foreach ($dataBarang as $barang)
                                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah barang" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                    text: '<i class="fas fa-plus"></i> Tambah Penerimaan',
                    className: 'btn-primary',
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    },
                    action: function(e, dt, node, config) {
                        window.location.href = "{{ url('admin/transaksi/tambah-penerimaan') }}";
                    }
                }]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $(document).ready(function() {
            $('#example1').on('click', '.btn-danger', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Hapus Penerimaan Barang',
                    text: "Apakah Anda yakin ingin menghapus data ini?",
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

            $('#editDataPenerimaan').on('click', function() {
                const idPenerimaan = $(this).val();
                // Fetch data for the selected penerimaan
                $.ajax({
                    url: "{{ url('admin/transaksi/get-penerimaan') }}/" + idPenerimaan,
                    method: 'GET',
                    success: function(response) {
                        $('#id_penerimaan').val(response.data.id_penerimaan);
                        $('#id_penerimaan_preview').val(response.data.id_penerimaan);
                        $('#barang_id').val(response.data.id_barang);
                        $('#jumlah').val(response.data.jumlah);
                        $('#editModal').modal('show');
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error
                        });
                    }
                });
            });
        });
    </script>
@endpush
