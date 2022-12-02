@extends('layouts.app')

@section('title', 'Store Cart')

@section('content')
    <!-- Page Content -->
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Beri Penilaian
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                <h1>
                    Berikan penilaian anda disini!
                </h1>
                <div class="card" style="background-color : black">
                    <div class="card-body">
                        <form action="{{ route('complaint.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label style="color: white">Keterangan</label>
                                        <textarea name="complaint" cols="10" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label style="color: white">Rating</label>
                                            <select name="rating" id="" class="form-control">
                                                <option value="1/5">1/5</option>
                                                <option value="2/5">2/5</option>
                                                <option value="3/5">3/5</option>
                                                <option value="4/5">4/5</option>
                                                <option value="5/5">5/5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn px-5"
                                        style="background-color: red; color :white">
                                        Berikan Penilaian
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="">Total Harga</h2>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="product-title text-success">Rp.{{ number_format($totalPrice ?? 0) }}</div>
                        <div class="product-subtitle">Total</div>
                    </div>
                    <div class="col-2 col-md-3">
                        @php
                            $alamat = \App\Models\Address::where('users_id', Auth::user()->id)->count();
                        @endphp
                        @if ($alamat >0)
                        <a href="{{route('checkout.index')}}"  class="btn btn-success btn-block">
                            Bayar Sekarang
                        </a>
                        @else
                        <a href="{{route('dashboard-settings-account')}}"  class="btn btn-success btn-block">
                            Tambahkan alamat terlebih dahulu
                        </a>
                        @endif
                       
                    </div>
                </div> --}}


                
                

                {{-- <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Cek Ongkir</h2>
                    </div>
                </div>
                <form action="/cart" method="POST" role="form">
                    @csrf
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col md-4">
                            <div class="form-group">
                                <label for="">Provinsi Asal</label>
                                <select name="province_origin" id="" class="form-control">
                                    <option value="">--Provinsi--</option>
                                    @foreach ($provinces as $province => $value)
                                        <option value="{{ $province }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kota Asal</label>
                                <select name="city_origin" id="" class="form-control">
                                    <option>--Kota--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Provinsi Tujuan</label>
                                <select name="province_destination" id="" class="form-control">
                                    <option value="">--Provinsi--</option>
                                    @foreach ($provinces as $province => $value)
                                        <option value="{{ $province }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kota Tujuan</label>
                                <select name="city_destination" id="" class="form-control">
                                    <option>--Kota--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kurir</label>
                                <select name="courier" id="" class="form-control">
                                    @foreach ($couriers as $courier => $value)
                                        <option value="{{ $courier }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Berat (g)</label>
                                <input type="number" name="weight" class="form-control" value="1000">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">Cek Ongkir</button>
                            </div>
                        </div>
                    </div>
                </form> --}}
                {{-- <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Detail Pengiriman</h2>
                    </div>
                </div> --}}
                {{-- <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Alamat</label>
                                <input type="text" class="form-control" id="address_one" aria-describedby="emailHelp"
                                    name="address_one" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="address_two" aria-describedby="emailHelp"
                                    name="address_two" />
                            </div>
                        </div>
                        <div class="col md-4">
                            <div class="form-group">
                                <label for="">Provinsi Asal</label>
                                <select name="province_origin" id="" class="form-control">
                                    <option value="">--Provinsi--</option>
                                    @foreach ($provinces as $province => $value)
                                        <option value="{{ $province }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kota Asal</label>
                                <select name="city_origin" id="" class="form-control">
                                    <option>--Kota--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Provinsi Tujuan</label>
                                <select name="province_destination" id="" class="form-control">
                                    <option value="">--Provinsi--</option>
                                    @foreach ($provinces as $province => $value)
                                        <option value="{{ $province }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kota Tujuan</label>
                                <select name="city_destination" id="" class="form-control">
                                    <option>--Kota--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kurir</label>
                                <select name="courier" id="" class="form-control">
                                    @foreach ($couriers as $courier => $value)
                                        <option value="{{ $courier }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Berat (g)</label>
                                <input type="number" name="weight" class="form-control" value="1000">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Kode Pos</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="country">Negara</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="Indonesia" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone_number">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" />
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2>Informasi Pembayaran</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        @if (Auth::user()->poin == 0)
                            <div class="col-4 col-md-4">
                                <div class="form-group">
                                    <label for="poin">Gunakan Poin</label>
                                    <input type="number" class="form-control" id="poin" name="point" disabled />
                                    <small style="color: red">Anda tidak mempunyai poin</small>
                                </div>
                            </div>
                        @else
                            <div class="col-4 col-md-4">
                                <div class="form-group">
                                    <label for="poin">Gunakan Poin</label>
                                    <input type="number" class="form-control" id="poin" name="point" />
                                </div>
                            </div>
                        @endif

                        <div class="col-2 col-md-2">
                            <div class="product-title">$580</div>
                            <div class="product-subtitle">Ongkos Kirim</div>
                        </div>

                        <div class="col-2 col-md-2">
                            <div class="product-title text-success">Rp.{{ number_format($totalPrice ?? 0) }}</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">


                        <div class="col-8 col-md-3">
                            <button type="submit" id="pay-button" class="btn btn-success mt-4 px-4 btn-block">
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </form> --}}
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{-- <script>
        var locations = new Vue({
            el: "#locations",
            // el: "#poin",
            mounted() {
                AOS.init();
                this.getProvincesData();
            },
            data: {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null,
                use_poin: false,
            },
            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                        .then(function(response) {
                            self.provinces = response.data;
                        })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            self.regencies = response.data;
                        })
                }
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                }
            },
            // data() {
            //     return {
            //         use_poin: true,
            //     }
            // }
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('select[name="province_origin"]').on('change', function() {
                let provinceId = $(this).val();
                if (provinceId) {
                    jQuery.ajax({
                        url: '/province/' + provinceId + '/cities',
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="city_origin"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="city_origin"]').append(
                                    '<option value=""' + key + ' >' + value +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="city_origin"]').empty();
                }
            });
            $('select[name="province_destination"]').on('change', function() {
                let provinceId = $(this).val();
                if (provinceId) {
                    jQuery.ajax({
                        url: '/province/' + provinceId + '/cities',
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="city_destination"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="city_destination"]').append(
                                    '<option value=""' + key + ' >' + value +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="city_destination"]').empty();
                }
            });
        });
    </script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('');
            // customer will be redirected after completing payment pop-up
        });
    </script>

    <script src="/script/navbar-scroll.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-FQqT2HK31VBoXDWw"></script>
@endpush
