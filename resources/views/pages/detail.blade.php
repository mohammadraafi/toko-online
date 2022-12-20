@extends('layouts.app')

@section('title', 'Detail Store')

@section('content')
    <!-- Page Content -->
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Produk
                                </li>
                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-gallery" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :key="photos[activePhoto].id" :src="photos[activePhoto].url" class="w-100 main-image"
                                alt="" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <h1>{{ $product->name }}</h1>
                        </div>
                        <div class="col-md-4">
                            <div class="price">
                                @if (!empty($product->discount_price))
                                    Rp.{{ number_format($product->discount_price) }}
                                    <s>Rp.{{ number_format($product->price) }} </s>
                                @else
                                    Rp.{{ number_format($product->price) }}
                                @endif
                            </div>
                            <div class="" style="color: black">Stok {{ number_format($product->quantity) }}</div>
                        </div>
                        <div class="col-lg-8" data-aos="zoom-in">
                            @auth
                                <form action="{{ route('details-add', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Quantity:</label>
                                        <input type="number" name="quantity_order" class="form-control w-25">
                                    </div>
                                    @if ($product->quantity == 0)
                                        <button class="btn btn-success nav-link px-4 text-white btn-block mb-3" type="submit"
                                            disabled>
                                            Stok Kosong
                                        </button>
                                    @else
                                        <button class="btn btn-success nav-link px-4 text-white btn-block mb-3" type="submit">
                                            Masukan Keranjang
                                        </button>
                                    @endif
                                </form>
                            @else
                                <a class="btn btn-success nav-link px-4 text-white btn-block mb-3"
                                    href="{{ route('login') }}">Silahkan Login terlebih dahulu</a>
                            @endauth

                        </div>
                    </div>
                </div>
            </section>
            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <p style="font-size: 25px; font-weight:bold;">Deskripsi</p>
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </section>
            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-3">
                            <h5>Ulasan Produk ({{ $review }})</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <ul class="list-unstyled">
                                @forelse ($reviews as $review)
                                    <li class="media">
                                        <div class="media-body">
                                            <img
                                            src="{{$review->user->photo}}"
                                            class="mr-3"
                                            alt=""
                                          />
                                            <h5 class="mt-2 mb-1">{{ $review->user->name }}</h5>
                                            <h5 class="mt-2 mb-1">{{ $review->rating }}</h5>
                                           <p> {{ $review->comment }}</p>
                                        </div>
                                    </li>
                                    <hr>
                                @empty
                                    <h5>Belum ada ulasan</h5>
                                @endforelse
                                {{-- <li class="media my-4">

                  <div class="media-body">
                    <h5 class="mt-2 mb-1">Anna Sukkirata</h5>
                    Color is great with the minimalist concept. Even I thought
                    it was made by Cactus industry. I do really satisfied with
                    this.
                  </div>
                </li>
                <li class="media">
                  <img
                    src="/images/icon-testimonial-3.png"
                    class="mr-3 rounded-circle"
                    alt=""
                  />
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">Dakimu Wangi</h5>
                    When I saw at first, it was really awesome to have with.
                    Just let me know if there is another upcoming product like
                    this.
                  </div>
                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->galleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ Storage::url($gallery->photos) }}",
                        },
                    @endforeach

                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>

    <script src="/script/navbar-scroll.js"></script>
@endpush
