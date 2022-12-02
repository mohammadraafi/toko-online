@extends('layouts.admin')

@section('title', 'Product')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transaksi</h2>
                <p class="dashboard-subtitle">
                    Daftar Transaksi
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <table class="table table-hover scroll-horizontal-vertical w-100 table-bordered"
                                        id="table1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Transaksi</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Status Transaksi</th>
                                                <th>Status Pengiriman</th>
                                                <th>Total Order</th>
                                                <th>Total Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $transaction->code }}</td>
                                                    <td>{{ $transaction->user->name }}</td>
                                                    <td>{{ $transaction->transaction_status }}</td>
                                                    <td>{{ $transaction->shipping_status }}</td>
                                                    <td>{{ $transaction->quantity_order }}</td>
                                                    <td>Rp. {{ number_format($transaction->total_price) }}</td>
                                                    <td>
                                                        <a href="{{ route('dashboard-transaction-details', $transaction->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fa fa-pencil d-inline"
                                                                style="margin-right: 5px"></i>Detail Transaksi</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#table1').DataTable();
        });
    </script>
@endpush
