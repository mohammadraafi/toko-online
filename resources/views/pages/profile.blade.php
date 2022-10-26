@extends('layouts.dashboard')

@section('title', 'Store Dashboard')

@section('content')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="section-content section-dashboard-home">
            <div class="container-fluid">
                <div class="dashboard-heading">
                    <h2 class="dashboard-title">Profile</h2>
                    <p class="dashboard-subtitle">
                        Profile {{ Auth::user()->name }}
                    </p>
                </div>
                <div class="dashboard-content">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-account') }}"
                                method="POST" enctype="multipart/form-data" id="locations">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="name"
                                                        aria-describedby="emailHelp" name="name"
                                                        value="{{ $user->name }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number">Nomor Telepon</label>
                                                    <input type="text" class="form-control" id="phone_number"
                                                        name="phone_number" value="{{ $user->phone_number }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-success px-5">
                                                    Update Profile
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="col-12">
                            @if (Auth::user()->photo)
                            <div class="card">
                                <img src="{{ asset(Auth::user()->photo) }}" alt="" width="20%" class="mb-2 mt-2 rounded-circle" >
                            </div>
                            <button type="button" class="btn btn-primary mt-5 mb-5" data-toggle="modal" data-target="#updateFoto-{{Auth::user()->id}}">
                                Ubah Foto Profile
                            </button>
                            @else
                            <h5 class="card-title">Foto profile belum di tambahkan</h5>
                            <button type="button" class="btn btn-primary mt-5 mb-5" data-toggle="modal" data-target="#updateFoto-{{Auth::user()->id}}">
                                Ubah Foto Profile
                            </button>
                            @endif
                            
                        </div>
                       

                    </div>
                </div>

                <div class="card mt-5 mb-5">
                    <div class="card-header">
                        Alamat
                    </div>
                    @php
                        $address = \App\Models\Address::where('users_id', Auth::user()->id)->count();
                    @endphp
                    @if ($address > 0)
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $alamat[0]->kota }},{{ $alamat[0]->prov }},{{ $alamat[0]->detail }}</h5>
                            <a href="{{ route('alamat-customer.edit', ['id' => $alamat[0]->id]) }}"
                                class="btn btn-primary">Ubah Alamat</a>
                        </div>
                    @else
                        <div class="card-body">
                            <h5 class="card-title">Alamat Belum di tambahkan</h5>
                           <a href="{{route('alamat-customer.create')}}" class="btn btn-primary btn-sm">Tambah Alamat</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Alamat -->
    <div class="modal fade" id="tambahAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('alamat-customer.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Pilih Provinsi</label>
                                    <select name="province_id" id="province_id" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($province as $provinsi)
                                            <option value="{{ $provinsi->province_id }}">{{ $provinsi->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-grup">
                                    <label for="">Pilih Kota/Kabupaten</label>
                                    <select name="city_id" id="city_id" class="form-control">
                                    </select>
                                </div>
                                <div class="form-grup">
                                    <label for="">Alamat Lengkap</label>
                                    <input type="text" name="detail" id=""
                                        placeholder="Kecamatan/Desa/Nama Jalan" class="form-control">
                                    </select>
                                </div>
                                <div class="mt-4 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal update foto -->
    <div class="modal fade" id="updateFoto-{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('dashboard-settings-photo') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Pilih Foto</label>
                                    <input type="file" class="form-control" name="photo">
                                </div>

                                <div class="mt-4 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
{{-- <script type="text/javascript">
    var toHtml = (tag, value) => {
        $(tag).html(value);
    }
    $(document).ready(function() {
        //  $('#province_id').select2();
        //  $('#cities_id').select2();
        $('#province_id').on('change', function() {
            var id = $('#province_id').val();
            var url = window.location.href;
            var urlNya = url.substring(0, url.lastIndexOf('/alamat/'));
            $.ajax({
                type: 'GET',
                url: urlNya + '/getcity/' + id,
                dataType: 'json',
                success: function(data) {
                    var op = '<option value="">Pilih Kota</option>';
                    if (data.length > 0) {
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            op +=
                                `<option value="${data[i].city_id}">${data[i].title}</option>`
                        }
                    }
                    toHtml('[name="city_id"]', op);
                }
            })
        })
    }); 
</script> --}}

{{-- <script type="text/javascript">
    var toHtml = (tag, value) => {
        $(tag).html(value);
    }
    $(document).ready(function() {
        //  $('#province_id').select2();
        //  $('#cities_id').select2();
        $('#province_id').on('change', function() {
            var id = $('#province_id').val();
            var url = window.location.href;
            $.ajax({
                type: 'GET',
                url: url + '/getcity/' + id,
                dataType: 'json',
                success: function(data) {
                    var op = '<option value="">Pilih Kota</option>';
                    if (data.length > 0) {
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            op +=
                                `<option value="${data[i].city_id}">${data[i].title}</option>`
                        }
                    }
                    toHtml('[name="cities_id"]', op);
                }
            })
        })
    });
</script> --}}
@endpush

{{-- @push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            var locations = new Vue({
                el: "#locations",
                mounted() {
                    AOS.init();
                    this.getProvincesData();
                },
                data: {
                    provinces: null,
                    regencies: null,
                    provinces_id: null,
                    regencies_id: null
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
                }
            });
        </script>
        <script src="/script/navbar-scroll.js"></script>
    @endpush --}}
