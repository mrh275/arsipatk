@extends('templates.admin-layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Penerimaan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                            <li class="breadcrumb-item active">Tambah Penerimaan</li>
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
                                <form action="{{ url('admin/transaksi/tambah-penerimaan') }}" method="post">
                                    @csrf
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
                                        <label for="jumlah">Jumlah Barang</label>
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah barang" required>
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
