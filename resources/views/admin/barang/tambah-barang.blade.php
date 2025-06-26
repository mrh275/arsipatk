@extends('templates.admin-layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Master</a></li>
                            <li class="breadcrumb-item active">Tambah Barang</li>
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
                                <form action="{{ url('admin/master/tambah-barang') }}" method="post">
                                    @csrf
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
