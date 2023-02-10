<div class="border-right bg-white " id="sidebar-wrapper" style="margin-top: 140px">

    <div class="list-group list-group-flush">
        <h1 class="list-group-item">Kategori</h1>
        @foreach ($categories as $category)
        <a href="{{ route('categories-detail', $category->slug) }}" class="list-group-item list-group-item-action bg-white">
            {{$category->name}}
        </a>
        <hr>

        @endforeach


        {{-- <a href="{{ route('dashboard-transactions.view-export') }}"
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

        <a href="{{ route('alamat-toko.index') }}" --}}
            {{-- class="list-group-item list-group-item-action bg-white {{ request()->is('admin/alamat-toko') ? 'active' : '' }}">Kelola
            Data Alamat Toko</a> --}}
    </div>
</div>
