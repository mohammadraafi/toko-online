@extends('layouts.admin')

@section('content')
    <div class="section-content section-dashboard-home mt-5" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Detail Pengaduan</h2>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @forelse ($pengaduans->details as $pengaduan)
                            <div class="card mb-3">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h4>Nama : {{ $pengaduan->user->name }}</h4>
                                            <h4>No.Telepon : {{ $pengaduan->user->phone_number }}</h4>
                                            <h4>Tanggal : {{ $pengaduan->created_at->format('d-m-Y - H:i:s') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div>
                                    <h3>Keterangan</h3>
                                    <p>{{ $pengaduan->keterangan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div>
                                    <h3 ">Foto</h3>
                                        <a href="{{ asset('storage/' . $pengaduan->foto) }}" target="_blank">
                                            <img src="{{ Storage::url($pengaduan->foto) }}" width="200"
                                                height="200" class="rounded-square">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div>
                                        <h3 >Status Pengaduan</h3>
                                        <div class="list-group">
                                             @forelse ($tanggapans as $tanggapan)
                                        <div class="list-group-item list-group-item-action mr-5">
                                            <div class="d-flex w-100 justify-content-between mr-5">
                                                <h5 class="mb-1" style="margin-right: 50px;">
                                                    {{ $tanggapan->status_pengaduan }}</h5>
                                            </div>
                                            <small>{{ $tanggapan->created_at }}</small>
                                            <p class="mb-1">{{ $tanggapan->tanggapan }}</p>
                                        </div>
                                    @empty
                                        <p>Belum di proses dan belum ada tanggapan</p>
                                        @endforelse
                                </div>
                            </div>
                        @empty
                            <h2>Tidak Ada Pengaduan</h2>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <a href="{{ route('tanggapan.show', $pengaduan->id) }}" class="btn btn-primary btn-lg active mb-5">Berikan
            Tanggapan</a>
    </div>
    </div>

@endsection
