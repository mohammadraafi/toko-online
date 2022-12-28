@extends('layouts.admin')

@section('title', 'Product')

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Update Data Promo</h2>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="card">
                    <div class="card-body">
                       <form action="{{route('product-discount.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                            @csrf
                            <div class="row">
                                <input type="text" name="users_id" class="form-control" value="{{Auth::user()->id}}" hidden>
                                <input type="text" name="weight" class="form-control" value="{{$item->weight}}" hidden>
                                <div class="col-md-12">
                                    <div class="form-group" hidden>
                                        <label>Nama Produk</label>
                                        <input type="text" name="name" class="form-control" required value="{{$item->name}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" hidden>
                                        <label>Harga Normal</label>
                                        <input type="number" name="price" class="form-control" value="{{$item->price}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Harga Promo</label>
                                        <input type="number" name="discount_price" class="form-control" required value="{{$item->discount_price}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" hidden>
                                        <label>Kategori Produk</label>
                                        <select name="categories_id" id="" class="form-control">
                                            <option value="{{$item->categories_id}}" selected>{{$item->category->name}}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" hidden>
                                        <label>Deskripsi Produk</label>
                                        <textarea name="description" id="editor">{!! $item->description !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" hidden>
                                    <label>Jumlah Produk</label>
                                    <input type="number" name="quantity" class="form-control" required value="{{$item->quantity}}">
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
