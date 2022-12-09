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
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$review->product->name}}</td>
                                        <td>{{$review->user->name}}</td>
                                        <td>{{$review->rating}}</td>
                                        <td>{{$review->comment}}</td>
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

<div class="section-content section-dashboard-home mt-5" data-aos="fade-up" >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Grafik Ulasan Produk</h2>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawStuff);
    function drawStuff() {
      var data = new google.visualization.arrayToDataTable([
        ['Move', 'Jumlah'],
        ["1/5", {{$satu}}],
        ["2/5", {{$dua}}],
        ["3/5", {{$tiga}}],
        ["4/5", {{$empat}}],
        ['5/5', {{$lima}}]
      ]);
      var options = {
        width: 800,
        legend: { position: 'none' },
        // chart: {
        //   title: 'Chess opening',
        //   subtitle: 'popularity by percentage' },
        axes: {
          x: {
            0: { side: 'top', label: 'Grafik Rating Ulasan Produk'} // Top x-axis.
          }
        },
        bar: { groupWidth: "90%" }
      };
      var chart = new google.charts.Bar(document.getElementById('top_x_div'));
      // Convert the Classic options to Material options.
      chart.draw(data, google.charts.Bar.convertOptions(options));
    };
  </script>
  <div id="top_x_div" style="width: 800px; height: 600px; margin-left:30px; margin-bottom:100px; margin-top:40px;"></div>
@endsection