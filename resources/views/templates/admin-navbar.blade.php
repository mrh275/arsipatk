<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Administrator</span>
                <div class="dropdown-divider"></div>
                <button type="button"" class="dropdown-item" id="change-password-button">
                    <i class="fas fa-key mr-2"></i> Ganti Kata Sandi
                </button>
                <div class="dropdown-divider"></div>
                <a href="{{ url('logout') }}" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

{{-- Edit Modal --}}
<div class="modal fade" id="changePasswordModal">
    <div class="modal-dialog">
        <form action="{{ url('admin/ganti-password') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Kata Sandi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="old_password">Kata Sandi Saat Ini</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_new_password">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="show-password" id="show-password">
                        <label for="show-password">Tampilkan Kata Sandi</label>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            // Show modal when button is clicked
            $('#change-password-button').on('click', function() {
                $('#changePasswordModal').modal('show');
            });

            // Toggle password visibility
            $('#show-password').on('change', function() {
                const type = $(this).is(':checked') ? 'text' : 'password';
                $('#old_password, #new_password, #confirm_new_password').attr('type', type);
            });

            // Handle form submission
            $('#changePasswordModal form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                const oldPassword = $('#old_password').val();
                const newPassword = $('#new_password').val();
                const confirmNewPassword = $('#confirm_new_password').val();
                if (!oldPassword || !newPassword || !confirmNewPassword) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Semua kolom harus diisi.',
                    });
                    return;
                } else if (newPassword !== confirmNewPassword) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Kata sandi baru dan konfirmasi tidak cocok.',
                    });
                    return;
                } else if (newPassword.length < 6) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Kata sandi baru harus minimal 6 karakter.',
                    });
                    return;
                }
                // You can add additional validation here if needed
                // Optionally, you can show a loading indicator or disable the submit button
                // Add input validation if input is empty
                // Submit the form via AJAX or regular form submission
                this.submit();
            })

        });
    </script>
@endpush
