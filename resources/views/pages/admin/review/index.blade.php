@extends('layouts.admin')

@section('title', 'Ulasan Produk')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Ulasan Produk</h2>
                <p class="dashboard-subtitle">
                    Daftar Ulasan Produk
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Produk</th>
                                                <th>Nama</th>
                                                <th>Rating</th>
                                                <th>Komentar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($reviews as $review)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $review->product->name }}</td>
                                                    <td>{{ $review->user->name }}</td>
                                                    <td>{{ $review->rating }}</td>
                                                    <td>{{ $review->comment }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak Ada Produk</td>
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

        <div class="section-content section-dashboard-home mt-5" data-aos="fade-up">
            <div class="container-fluid">
                <div class="dashboard-heading">
                    <h2 class="dashboard-title">Grafik Ulasan Produk</h2>
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
                    ['Buruk', {{ $satu }}],
                    ["Kurang Baik", {{ $dua }}],
                    ["Cukup Baik", {{ $tiga }}],
                    ["Baik", {{ $empat }}],
                    ['Sangat Baik', {{ $lima }}]
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
                                label: 'Grafik Rating Ulasan Produk'
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
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-lg-8">
                    <div id="top_x_div" style="width: 800px; height: 600px; "></div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Buruk =
                                    <i class="fa fa-star"></i>
                                </li>
                                <li class="list-group-item">Kurang Baik =
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </li>
                                <li class="list-group-item">Cukup Baik =
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </li>
                                <li class="list-group-item">Baik =
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </li>
                                <li class="list-group-item">Sangat Baik =
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('addon-script')
        <script>
            $(document).ready(function() {
                $('#crudTable').DataTable();
            });
        </script>
    @endpush
