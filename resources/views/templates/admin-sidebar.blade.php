<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('') }}" class="brand-link text-center">
        <span class="brand-text font-weight-semibold" style="font-size: 1.8rem !important">Arsip<b>ATK</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info text-white">
                {{ session('name') }}
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ $dropdown == 'master' ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ $dropdown == 'master' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/master/barang') }}" class="nav-link {{ $active == 'barang' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/master/kategori') }}" class="nav-link {{ $active == 'kategori' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $dropdown == 'transaksi' ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ $dropdown == 'transaksi' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/transaksi/data-permintaan') }}" class="nav-link {{ $active == 'permintaan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permintaan</p>
                            </a>
                        </li>
                        @if (session('user_role') == 'admin')
                            <li class="nav-item">
                                <a href="{{ url('admin/transaksi/data-penerimaan') }}" class="nav-link {{ $active == 'penerimaan' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penerimaan</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item {{ $dropdown == 'laporan' ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ $dropdown == 'laporan' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-paste"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (session('user_role') == 'admin')
                            <li class="nav-item">
                                <a href="{{ url('admin/laporan/persediaan') }}" class="nav-link {{ $active == 'laporan-persediaan' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Persediaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/laporan/penerimaan') }}" class="nav-link {{ $active == 'laporan-penerimaan' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penerimaan</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/laporan/permintaan') }}" class="nav-link {{ $active == 'laporan-permintaan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permintaan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
