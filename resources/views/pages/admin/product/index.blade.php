@extends('layouts.admin')

@section('title', 'Product')

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Produk</h2>
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
                            <div class="col-3">
                                <a href="{{route('product.create')}}" class="btn btn-primary mb-3"> + Tambah Produk Baru</a>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('product-gallery.index') }}" class="btn btn-primary mb-3">Lihat Foto Produk</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Berat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>

                                        <td>{{$product->name}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->weight}} (gr)</td>
                                        <td>
                                            <div class= "btn-group">
                                                <div class= "dropdown">
                                                    <button class="btn btn-primay dropdown-toggle mr-1 mb-1"
                                                        type="button"
                                                        data-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('product.edit', $product->id)}}">
                                                            Edit
                                                        </a>
                                                        <form action="{{route('product.destroy', $product->id)}}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak Ada Produk</td>
                                        </tr>

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

{{-- @push('addon-script')
    <script>
        $(document).ready(function() {
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            // ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
                type: 'GET',

            },
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'category.name', name: 'category.name'},
                {data: 'price', name: 'price'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ],
            order: [
                    [0, 'asc']
                ]
        });
        });
    </script>
@endpush --}}
