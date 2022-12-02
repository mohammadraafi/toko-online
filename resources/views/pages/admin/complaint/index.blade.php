@extends('layouts.admin')

@section('title', 'Penilaian')
    
@section('content')
<div class="section-content section-dashboard-home">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Penilaian Kepuasan Pelayanan</h2>
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
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($complaints as $complaint)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$complaint->user->name}}</td>
                                        <td>{{$complaint->complaint}}</td>
                                        <td>{{$complaint->rating}}</td>
                                        <td>{{$complaint->status}}</td>
                                        <td>
                                            @if ($complaint->status == 'Belum direspon')
                                            <a href="{{route('responses.add', $complaint->id)}}"
                                                class="btn btn-primary btn-sm active mb-5">Berikan tanggapan</a>
                                            @endif
                                        </td>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak Ada Produk</td>
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

<div class="modal fade" id="responses-{{ $complaint->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Berikan Tanggapan kepada {{ $complaint->user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('responses.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="complaints_id" value="{{ $complaint->id }} ">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tanggapan</label>
                                <input type="text" name="responses" class="form-control" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Tanggapi</button>
            </div>
        </form>

        </div>
    </div>
</div>
@endsection
