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
                                <form action="{{ url('admin/transaksi/tambah-permintaan') }}" method="post">
                                    @csrf
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
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
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
@endpush
