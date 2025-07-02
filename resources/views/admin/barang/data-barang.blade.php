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
                                            <th>ID Barang</th>
                                            <th>Nama Kategori</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan Barang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataBarang as $barang)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $barang->id_barang }}</td>
                                                <td>{{ $barang->kategori->nama_kategori }}</td>
                                                <td>{{ $barang->nama_barang }}</td>
                                                <td>{{ $barang->satuan_barang }}</td>
                                                <td>
                                                    <button type="button" value="{{ $barang->id_barang }}" class="btn btn-warning btn-sm" id="editBarang">
                                                        Edit
                                                    </button>
                                                    <a href="{{ url('admin/master/barang/hapus') . '/' . $barang->id_barang }}" class="btn btn-danger btn-sm">
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
            <form action="{{ url('admin/master/barang/update') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Kategori</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="id_barang">ID Barang</label>
                            <input type="hidden" class="form-control" id="id_barang" name="id_barang" required>
                            <input type="text" class="form-control" id="id_barang_preview" name="id_barang_preview" disabled="disabled" required>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori Barang</label>
                            <select name="id_kategori" class="form-control" id="id_kategori">
                                <option value="">Pilih :</option>
                                @foreach ($dataKategori as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" required>
                        </div>
                        <div class="form-group">
                            <label for="satuan_barang">Satuan Barang</label>
                            <input type="text" class="form-control" id="satuan_barang" name="satuan_barang" placeholder="Masukkan nama satuan barang" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
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
                    text: '<i class="fas fa-plus"></i> Tambah Barang',
                    className: 'btn-primary',
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    },
                    action: function(e, dt, node, config) {
                        window.location.href = "{{ url('admin/master/tambah-barang') }}";
                    }
                }]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $(document).ready(function() {
            $('#example1').on('click', '.btn-danger', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Hapus Barang',
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

            $('#example1').on('click', '#editBarang', function() {
                const idBarang = $(this).val();
                // Fetch data for the selected penerimaan
                $.ajax({
                    url: "{{ url('admin/master/barang') }}/" + idBarang,
                    method: 'GET',
                    success: function(response) {
                        $('#id_barang').val(response.data.id_barang);
                        $('#id_barang_preview').val(response.data.id_barang);
                        $('#id_kategori').val(response.data.kategori.id_kategori);
                        $('#nama_barang').val(response.data.nama_barang);
                        $('#satuan_barang').val(response.data.satuan_barang);
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
