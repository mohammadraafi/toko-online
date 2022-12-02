@extends('layouts.admin')

@section('title', 'Product')
    
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Kelola Data Promo</h2>
        <p class="dashboard-subtitle">
            Daftar Produk
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover scroll-horizontal-vertical" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Harga Normal</th>
                                        <th>Harga Promo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>Rp.{{number_format($product->price)}}</td>
                                            @if (!empty($product->discount_price))
                                            <td>Rp.{{number_format($product->discount_price)}}</td>
                                            
                                            @else
                                                <td>Belum ada promo</td>
                                            @endif
                                            <td>
                                                @if (!empty($product->discount_price))
                                                    <form action="{{route('product-discount.destroy', $product->id)}}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm mb-2">
                                                        <i class="fa fa-check"></i>Hapus Promo
                                                        </button>
                                                    </form>
                                                    <a href="{{route('product-discount.edit', $product->id)}}" class="btn btn-sm btn-primary mb-2">Update Promo</a>
                                                @else
                                                <a href="{{route('product-discount.add', $product->id)}}" class="btn btn-sm btn-primary">Tambah Promo</a>
                                                @endif

                                                   
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak Ada Produk</td>
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
@endsection