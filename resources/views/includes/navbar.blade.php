<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/images/logos.png" alt="logo" width="75" height="75">
        </a>
        @auth
            @php
                $poin = \App\User::where('id', Auth::user()->id)->sum('poin');
            @endphp
            <h5 class="mt-2 ml-5">Poin : Rp.{{ number_format($poin) }}</h5>
        @endauth

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('all-product') }}">Semua Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories') }}">Kategori</a>
                </li>
                @auth
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('kritik-customer.index') }}">Pengaduan</a>
                </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('history-transaction.index') }}">Transaksi</a>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success nav-link px-4 text-white" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest
            </ul>
            @auth
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{Auth::user()->photo}}" alt="" class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- <a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a> --}}
                            <a class="dropdown-item" href="{{ route('dashboard-settings-account') }}">Profile</a>
                            {{-- <a class="dropdown-item" href="{{ route('alamat-customer.index') }}">Alamat</a> --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block mt-2" href="{{ route('cart') }}">
                            @php
                                $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp
                            @if ($carts > 0)
                                <img src="/images/icon-cart-filled.svg" alt="">
                                <div class="cart-badge">{{ $carts }}</div>
                            @else
                                <img src="/images/icon-cart-empty.svg" alt="" />
                            @endif
                        </a>
                    </li>
                </ul>

                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
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
            @endauth
        </div>
    </div>
</nav>
