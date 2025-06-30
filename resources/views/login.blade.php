@extends('templates.layout')

@section('content')
    <div class="hold-transition login-page">
        <div class="row mb-4">
            <div class="col-12">
                <img src="{{ url('assets/img/logo.png') }}" alt="Logo Sekolah" class="brand-img-login">
                <h3 class="brand-text-login">SMAIT Al Irsyad <br>Al Islamiyah Karawang</h3>
            </div>
        </div>
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ url('') }}" class="h1">Arsip<b>ATK</b></a>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="{{ url('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="show-password">
                                    <label for="show-password">
                                        Show Password
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
    </div>
@endsection

@push('styles')
    <style>
        h3.brand-text-login {
            text-align: center;
            margin-top: 10px;
            font-weight: 600;
        }

        img.brand-img-login {
            display: block;
            margin: 0 auto;
            width: 15rem;
            height: auto;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#show-password').on('change', function() {
                const passwordField = $('input[type="password"]');
                if ($(this).is(':checked')) {
                    passwordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                }
            });
        });
    </script>
@endpush
