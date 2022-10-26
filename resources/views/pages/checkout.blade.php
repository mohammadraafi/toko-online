@extends('layouts.app')

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="/cart">Keranjang</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Checkout
                                </li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Detail Pesanan</h2>
                                <div class="p-3 p-lg-5 border">
                                    <form action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <table class="table site-block-order-table mb-5">
                                            <thead>
                                                <th>Produk</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <?php $total_price = 0; ?>
                                                @foreach ($keranjangs as $keranjang)
                                                    <tr>
                                                        <td>{{ $keranjang->product->name }} <strong
                                                                class="mx-2">x</strong>
                                                            {{ $keranjang->quantity_order }}</td>
                                                        <?php
                                                        if (!empty($keranjang->product->discount_price)) {
                                                            $total = $keranjang->product->discount_price * $keranjang->quantity_order;
                                                        } else {
                                                            $total = $keranjang->product->price * $keranjang->quantity_order;
                                                        }
                                                        
                                                        $total_price = $total_price + $total;
                                                        ?>
                                                        <td>Rp. {{ number_format($total, 2, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>
                                                        Ongkir
                                                    </td>
                                                    <td>
                                                        Rp .{{ number_format($ongkir, 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Jumlah
                                                            Pembayaran</strong>
                                                    </td>
                                                    <td class="text-black font-weight-bold">
                                                        <?php $alltotal = $total_price + $ongkir; ?>
                                                        <strong>Rp. {{ number_format($alltotal, 2, ',', '.') }}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Penerima</td>
                                                    <td>{{ $alamat->detail }}, {{ $alamat->kota }}, {{ $alamat->prov }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @if (Auth::user()->poin == 0)
                                            <div class="form-group">
                                                <label for="">Gunakan Poin</label>
                                                <input type="number" class="form-control" id="poin" name="point"
                                                    disabled />
                                                <small style="color: red">Anda tidak mempunyai poin</small>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="poin">Gunakan Poin</label>
                                                <input type="number" class="form-control" id="poin" name="point" />
                                            </div>
                                        @endif
                                        <input type="hidden" name="total_price" value="{{ $alltotal }}">
                                        <input type="hidden" name="shipping_price" value="{{ $ongkir }}">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-lg py-3 btn-block" type="submit"
                                                id="pay-button">Bayar Sekarang</button>
                                            <small>Mohon periksa alamat penerima dengan benar agar tidak terjadi salah
                                                pengiriman</small>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
        {{-- <section class="store-cart">
      <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
              <div class="col-12 table-responsive">
                  <table class="table table-borderless table-cart" aria-describedby="Cart">
                      <thead>
                          <tr>
                              <th scope="col">Foto</th>
                              <th scope="col">Nama Produk</th>
                              <th scope="col">Jumlah</th>
                              <th scope="col">Harga</th>
                              <th scope="col">Total Harga</th>
                              <th scope="col">Menu</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php $totalPrice = 0 @endphp
                          @foreach ($carts as $cart)
                              <tr>
                                  <td style="width: 25%;">
                                      @if ($cart->product->galleries)
                                          <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                              alt="" class="cart-image" />
                                      @endif
                                  </td>
                                  <td style="width: 35%;">
                                      <div class="product-title">{{ $cart->product->name }}</div>
                                  </td>
                                  <td style="width: 20%;">
                                      <div class="product-title">{{ number_format($cart->quantity_order) }}</div>
                                  </td>
                                  <td style="width: 35%;">
                                      <div class="product-title">Rp.{{ number_format($cart->product->price) }}</div>
                                      <div class="product-subtitle">Rupiah</div>
                                  </td>
                                  <td style="width: 35%;">
                                      <div class="product-title">Rp.{{ number_format($cart->total_price) }}</div>
                                      <div class="product-subtitle">Rupiah</div>
                                  </td>
                                  <td style="width: 20%;">
                                      <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                          @method('delete')
                                          @csrf
                                          <button type="submit" class="btn btn-remove-cart">
                                              Remove
                                          </button>
                                      </form>
                                  </td>
                              </tr>
                              @php $totalPrice += $cart->total_price @endphp
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>


        
      </div>
  </section> --}}
    </div>
@endsection

@push('addon-script')
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('');
            // customer will be redirected after completing payment pop-up
        });
    </script>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-FQqT2HK31VBoXDWw"></script>
@endpush
