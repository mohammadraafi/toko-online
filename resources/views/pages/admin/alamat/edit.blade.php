@extends('layouts.admin')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Alamat Toko</h2>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Ubah Alamat
                            </div>
                            <div class="card-body">
                                <form action="{{ route('alamat-toko.update', ['id' => $id]) }}" method="POST"
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
    </div>
@endsection

@push('addon-script')
    <script type="text/javascript">
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
    </script>
@endpush
