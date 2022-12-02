@extends('layouts.admin')

@section('title', 'Product')
    
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Kelola Data Promo</h2>
        <p class="dashboard-subtitle">
           Tambah Harga Promo
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all as $error)
                                <li> {{ $error}} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                       <form action="{{route('product-discount.store', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                            @csrf
                            <div class="row">
                                <input type="text" name="users_id" class="form-control" value="{{Auth::user()->id}}" hidden>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Harga Normal</label>
                                        <input type="number" name="price" class="form-control" value="{{$product->price}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Harga Promo</label>
                                        <input type="number" name="discount_price" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" hidden>
                                        <label>Kategori Produk</label>
                                        <select name="categories_id" id="" class="form-control">
                                            <option value="{{$product->categories_id}}" selected>{{$product->category->name}}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" hidden>
                                        <label>Deskripsi Produk</label>
                                        <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" hidden>
                                    <label>Jumlah Produk</label>
                                    <input type="number" name="quantity" class="form-control" required value="{{$product->quantity}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush