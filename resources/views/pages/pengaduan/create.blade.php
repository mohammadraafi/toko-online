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
                                <li class="breadcrumb-item"><a href="{{route('pengaduan.pelanggan.index')}}">Komplain</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Beri Komplain
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
                    Berikan Komplain
                </h1>
                <div class="card" style="background-color : black">
                    <div class="card-body">
                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="text" name="users_id" class="form-control" hidden value="{{Auth::user()->id}}"> --}}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label style="color: white">Keterangan</label>
                                        <textarea name="keterangan" cols="10" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label style="color: white">Foto</label>
                                        <input type="file" name="foto" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn px-5"
                                        style="background-color: red; color :white">
                                        Berikan Komplain
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

    {{-- <script>
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
    </script> --}}

    <script src="/script/navbar-scroll.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-FQqT2HK31VBoXDWw"></script>
@endpush
