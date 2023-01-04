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
                                    <li class="breadcrumb-item"><a href="{{route('pengaduan.pelanggan.index')}}">Pengaduan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Detail Pengaduan
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <section class="store-cart">
                <div class="container">
                    <div class="row d-block mx-0">
                        @auth
                            <div class="headline font-red-hat-display">
                                Data Pengaduan
                            </div>
                            <div class="section-content section-dashboard-home" data-aos="fade-up">
                                <div class="container-fluid">
                                    <div class="dashboard-heading">
                                        <h2 class="dashboard-title text-white">Detail Pengaduan</h2>
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
                                                                    <h4>Tanggal :
                                                                        {{ $pengaduan->created_at->format('d-m-Y - H:i:s') }}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div>
                                                            <h3 class="text-center">Keterangan</h3>
                                                            <p>{{ $pengaduan->keterangan }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div>
                                                            <h3 class="text-center">Foto</h3>
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
                                                            <h3 class="text-center">Status Pengaduan</h3>
                                                            <div class="list-group">
                                                                @forelse ($tanggapans as $tanggapan)
                                                                    <div class="list-group-item list-group-item-action">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="mb-1">{{ $tanggapan->status_pengaduan }}
                                                                            </h5>
                                                                            <small>{{ $tanggapan->created_at }}</small>
                                                                        </div>
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
                            </div>
                        @endauth

                    </div>

                </div>
            </section>
        </div>
    @endauth
@endsection
