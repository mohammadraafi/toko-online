@extends('layouts.app')

@section('title', 'Semesta Comp')

@section('content')
<div class="page-content page-home">
    <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#storeCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#storeCarousel" data-slide-to="1"></li>
                            <li data-target="#storeCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/images/banner1.png" class="d-block w-100" alt="Carousel Image" />
                            </div>
                            <div class="carousel-item">
                                <img src="/images/banner2.png" class="d-block w-100" alt="Carousel Image" />
                            </div>
                            <div class="carousel-item">
                                <img src="/images/bannerlogo.png" class="d-block w-100" alt="Carousel Image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Produk Highlight</h5>
                </div>
            </div>
            <div class="row">
                @php
                    $incrementProduct = 0;
                @endphp
                @forelse ($products as $product)
                    @if ($product->discount_price)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                            data-aos-delay="{{ $incrementProduct += 100 }}">
                            <a class="component-products d-block" href="{{ route('details', $product->id) }}">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style="
                                                 @if ($product->galleries) background-image: url('{{ Storage::url($product->galleries->first()->photos ?? '') }}');
                                                 @else
                                                background-color: #eee @endif
                                                ">
                                    </div>
                                </div>
                                <div class="products-text">
                                    {{ $product->name }}
                                </div>
                                <div class="products-price">
                                    @if (!empty($product->discount_price))
                                        Rp.{{ number_format($product->discount_price) }} <br>
                                        <s>Rp.{{ number_format($product->price) }} </s>
                                    @else
                                        Rp.{{ number_format($product->price) }}
                                    @endif
                                </div>
                                @if ($product->selling == null)
                                <div class="products-text">
                                    0 Terjual
                                </div>
                                @else
                                <div class="products-text">
                                    {{$product->selling}} Terjual
                                </div>
                                @endif

                            </a>
                        </div>
                    @endif

                @empty
                    <div class="col-12 text-center">
                        Belum ada produkk
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>

@endsection
