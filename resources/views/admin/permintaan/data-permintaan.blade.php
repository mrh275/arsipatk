@extends('templates.admin-layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Permintaan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                            <li class="breadcrumb-item active">Permintaan</li>
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
                                            <th>Stok Barang</th>
                                            <th>Tanggal Permintaan</th>
                                            <th>Status</th>
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
                                                <td>{{ $permintaan->barang->stok_barang }}</td>
                                                <td>{{ $permintaan->tanggal_permintaan }}</td>
                                                <td><span class="badge {{ $permintaan->status_permintaan == 'approved' ? 'bg-success' : ($permintaan->status_permintaan == 'rejected' ? 'bg-danger' : 'bg-warning') }}">{{ $permintaan->status_permintaan }}</span></td>
                                                <td>
                                                    {{-- <button type="button" value="{{ $permintaan->id_permintaan }}" id="editDataPermintaan" class="btn btn-warning btn-sm">
                                                        Edit
                                                    </button> --}}
                                                    {{-- <a href="{{ url('admin/transaksi/get-permintaan') . '/' . $permintaan->id_permintaan }}" id="editDataPermintaan" class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a> --}}
                                                    @if (session('user_role') == 'user')
                                                        <a href="{{ url('admin/transaksi/permintaan/hapus') . '/' . $permintaan->id_permintaan }}" {{ $permintaan->status_permintaan == 'pending' ? '' : 'aria-disabled="true"' }} class="btn btn-danger btn-sm {{ $permintaan->status_permintaan == 'pending' ? '' : 'disabled' }}">
                                                            Hapus
                                                        </a>
                                                    @endif
                                                    @if (session('user_role') == 'admin')
                                                        <button type="button" id="verifikasi-permintaan" {{ $permintaan->status_permintaan == 'pending' ? '' : 'disabled' }} value="{{ $permintaan->id_permintaan }}" class="btn btn-success btn-sm">
                                                            Verifikasi
                                                        </button>
                                                    @endif
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
            <form action="{{ url('admin/transaksi/update-permintaan') }}" method="post">
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
                            <label for="id_permintaan">ID Permintaan</label>
                            <input type="hidden" class="form-control" id="id_permintaan" name="id_permintaan" required>
                            <input type="text" class="form-control" id="id_permintaan_preview" name="id_permintaan_preview" disabled="disabled" required>
                        </div>
                        <div class="form-group">
                            <label for="issued_by">Issued By</label>
                            <input type="text" class="form-control" id="issued_by" name="issued_by" placeholder="Masukkan nama yang mengeluarkan permintaan" required>
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
                            <label for="jumlah_permintaan">Jumlah Permintaan</label>
                            <input type="number" class="form-control" id="jumlah_permintaan" name="jumlah_permintaan" placeholder="Masukkan jumlah permintaan" required>
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
            @if (session('user_role') == 'user')
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
            @elseif (session('user_role') == 'admin')
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                });
            @endif
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

            $('#example1').on('click', '#verifikasi-permintaan', function() {
                const idPermintaan = $(this).val();
                Swal.fire({
                    title: 'Verifikasi Permintaan',
                    text: "Apakah Anda yakin ingin memverifikasi permintaan dengan kode " + idPermintaan + " ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Approve',
                    denyButtonText: 'Reject',
                    showDenyButton: true,
                }).then((result) => {
                    if (result.isConfirmed || result.isDenied) {

                        $.ajax({
                            url: "{{ url('admin/transaksi/permintaan/verifikasi-permintaan') }}",
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id_permintaan: idPermintaan,
                                status_permintaan: result.isConfirmed ? 'approved' : 'rejected'
                            },
                            success: function(response) {
                                console.log(response.message);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.responseJSON.message
                                });
                            }
                        });
                    }
                });
            });

            $('#example1').on('click', '#editDataPermintaan', function() {
                const idPermintaan = $(this).val();
                // Fetch data for the selected permintaan
                $.ajax({
                    url: "{{ url('admin/transaksi/get-permintaan') }}/" + idPermintaan,
                    method: 'GET',
                    success: function(response) {
                        $('#id_permintaan').val(response.data.id_permintaan);
                        $('#id_permintaan_preview').val(response.data.id_permintaan);
                        $('#issued_by').val(response.data.issued_by);
                        $('#barang_id').val(response.data.id_barang);
                        $('#jumlah_permintaan').val(response.data.jumlah_permintaan);
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
