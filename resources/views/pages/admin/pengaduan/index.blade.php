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
                                                <th>Tanggal</th>
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

        <div class="section-content section-dashboard-home mt-4" data-aos="fade-up">
            <div class="container-fluid">
                <div class="dashboard-heading">
                    <h2 class="dashboard-title">Grafik Komplain Produk</h2>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawStuff);
            let satu = document.getElementById("1");

            function drawStuff() {
                var data = new google.visualization.arrayToDataTable([
                    ['Move', 'Jumlah'],
                    ['Belum diproses', {{ $belumDiproses }}],
                    ["Sedang diproses", {{ $sedangDiproses }}],
                    ["Selesai", {{ $selesai }}],
                ]);
                var options = {
                    width: 800,
                    legend: {
                        position: 'none'
                    },
                    // chart: {
                    //   title: 'Chess opening',
                    //   subtitle: 'popularity by percentage' },
                    axes: {
                        x: {
                            0: {
                                side: 'top',
                                label: 'Grafik Komplain Produk'
                            } // Top x-axis.
                        }
                    },
                    bar: {
                        groupWidth: "90%"
                    }
                };
                var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                // Convert the Classic options to Material options.
                chart.draw(data, google.charts.Bar.convertOptions(options));
            };
        </script>
        <div class="container-fluid">
            <div class="row">
                <div id="top_x_div" style="width: 800px; height: 600px; "></div>
            </div>
        </div>
    @endsection
