<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="border-right bg-whitec " id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/logos.png" alt="" class="my-4" style="max-width: 150px" />
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin-dashboard') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('admin') ? 'active' : '' }}">Laporan
                        Penjualan</a>

                    <a href="{{ route('dashboard-transactions.view-export') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('admin/export-transaction') ? 'active' : '' }}">Cetak
                        Laporan Transaksi Penjualan</a>

                    <a href="{{ route('category.index') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('admin/category') ? 'active' : '' }}">Kelola
                        Data Kategori</a>

                    <a href="{{ route('product.index') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('admin/product') ? 'active' : '' }}">Kelola
                        Data Produk</a>

                    <a href="{{ route('product-discount.index') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('admin/product-discount') ? 'active' : '' }}">Kelola
                        Data Promo</a>


                    <a href="{{ route('dashboard-transactions') }}"
                        class="list-group-item list-group-item-action bg-whiter {{ request()->is('admin/transactions') ? 'active' : '' }}">Kelola
                        Data Transaksi
                    </a>

                    <a href="{{ route('review.index') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('ulasan-produk') ? 'active' : '' }}">Kelola
                        Data Ulasan Produk
                    </a>

                    <a href="{{ route('pengaduan.index') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('pengaduan') ? 'active' : '' }}">Kelola
                        Data Komplain
                    </a>

                    <a href="{{ route('kritik.index') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('complaint') ? 'active' : '' }}">Kelola
                        Data Kritik & Saran
                    </a>

                    <a href="{{ route('user.index') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('admin/user') ? 'active' : '' }}">Kelola
                        Data Pelanggan</a>

                    <a href="{{ route('alamat-toko.index') }}"
                        class="list-group-item list-group-item-action bg-white {{ request()->is('admin/alamat-toko') ? 'active' : '' }}">Kelola
                        Data Alamat Toko</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-store navbar-expand-lg navbar-light fixed-top" data-aos="fade-down">
                    <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                        &laquo; Menu
                    </button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto d-none d-lg-flex">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="/images/profile-user.png" alt=""
                                        class="rounded-circle mr-2 profile-picture" />
                                    Hi, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"">Logout</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <!-- Mobile Menu -->
                        <ul class="navbar-nav d-block d-lg-none mt-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Hi, {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-inline-block" href="#">
                                    Cart
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                @yield('content')
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    @stack('addon-script')
</body>

</html>
