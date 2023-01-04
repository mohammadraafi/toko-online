@extends('layouts.admin')

@section('title', 'pengaduan & Saran')

@section('content')
    <div class="section-content section-dashboard-home mt-5">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Komplain</h2>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Keterangan</th>
                                                <th>Foto</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pengaduans as $pengaduan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pengaduan->user->name }}</td>
                                                    <td>{{ $pengaduan->keterangan }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/' . $pengaduan->foto) }}"
                                                            target="_blank">
                                                            <img src="{{ Storage::url($pengaduan->foto) }}" width="50"
                                                                height="50" class="rounded-square">
                                                        </a>
                                                    </td>
                                                    @if (empty($pengaduan->tanggapan->status_pengaduan))
                                                        <td>Belum di Respon</td>
                                                    @else
                                                        <td>{{ $pengaduan->tanggapan->status_pengaduan }}</td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('pengaduan.show', $pengaduan->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                style="margin-right: 5px"></i>Lihat Komplain</a>
                                                        @if ($pengaduan->status == 'Belum diproses')
                                                            <a href="{{ route('tanggapan.show', $pengaduan->id) }}"
                                                                class="btn btn-primary btn-sm active mb-5">Berikan
                                                                tanggapan</a>
                                                        @endif
                                                    </td>
                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak Ada Komplain</td>
                                                </tr>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
