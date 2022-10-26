@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
    <!-- Page Content -->
    <div class="page-content page-dikemas">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Transaksi
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12">
                        <h2 class="mb-4">Dikemas</h2>
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="dikemas">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Status Transaksi</th>
                                    <th scope="col">Total Order</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dikemass as $dikemas)
                                    <tr>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $dikemas->code }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $dikemas->transaction_status }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $dikemas->quantity_order }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">Rp.{{ number_format($dikemas->total_price) }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $dikemas->created_at->format('D-M-Y H:i:s') }}
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="{{ route('history-transaction.show', $dikemas->id) }}"
                                                class="btn btn-sm btn-success">Detail Transaksi</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak Ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Dikirim</h2>
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="transaction">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Status Transaksi</th>
                                    <th scope="col">Total Order</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dikirimm as $dikirim)
                                    <tr>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $dikirim->code }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $dikirim->transaction_status }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $dikirim->quantity_order }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">Rp.{{ number_format($dikirim->total_price) }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $dikirim->created_at->format('D-M-Y H:i:s') }}
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="{{ route('history-transaction.show', $dikirim->id) }}"
                                                class="btn btn-sm btn-info">Detail Transaksi</a>

                                            <form action="{{ route('history-transaction.recieved', $dikirim->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success mt-2">
                                                    Pesanan Diterima
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak Ada transaction</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Selesai</h2>
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="transaction">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Status Transaksi</th>
                                    <th scope="col">Total Order</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($selesaii as $selesai)
                                    <tr>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $selesai->code }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $selesai->transaction_status }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $selesai->quantity_order }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">Rp.{{ number_format($selesai->total_price) }}</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $selesai->created_at->format('D-M-Y H:i:s') }}
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <a href="{{ route('history-transaction.show', $selesai->id) }}"
                                                class="btn btn-sm btn-success">Detail Transaksi</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak Ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
