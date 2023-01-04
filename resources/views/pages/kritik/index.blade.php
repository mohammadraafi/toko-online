@extends('layouts.app')

@section('title', 'Kritik')

@section('content')
@auth
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
                                    Kritik & Saran
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                {{-- <h1>
                    Berikan saran anda disini!
                </h1> --}}
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('kritik.create') }}" class="btn btn-primary mb-3">Berikan Kritik & Saran</a>
                        <div>
                            <table
                                class="table table-hover scroll-horizontal-vertical w-100 table-bordered table-striped"
                                id="table1">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kritik</th>
                                        <th>Saran</th>
                                        <th>Tanggapan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kritiks as $kritik)
                                        <tr>
                                            <td>{{ $kritik->created_at->format('d F Y - H:i:s') }}</td>
                                            <td>{{$kritik->kritik}}</td>
                                            <td>{{ $kritik->saran}}</td>
                                            @if (empty($kritik->tanggapan->responses))
                                                <td>Belum ada tanggapan</td>
                                            @else
                                            <td>{{$kritik->tanggapan->responses}}</td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak Ada kritik</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endauth


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
