@extends('layouts.admin')

@section('title', 'Laporan Penjualan')
    
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up" style="margin-top: 100px">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Laporan Penjualan</h2>
        <p class="dashboard-subtitle">
            
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row">
        <div class="col-md-4">
            <div class="card mb-2">
            <div class="card-body">
                <div class="dashboard-card-title">
                Pelanggan
                </div>
                <div class="dashboard-card-subtitle">
                {{$customer}}
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-2">
            <div class="card-body">
                <div class="dashboard-card-title">
                Pendapatan
                </div>
                <div class="dashboard-card-subtitle">
                Rp.{{number_format($revenue)}}
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-2">
            <div class="card-body">
                <div class="dashboard-card-title">
                Transaksi
                </div>
                <div class="dashboard-card-subtitle">
                    {{$transactions}}
                </div>
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
                    <h2 class="dashboard-title">Grafik Status Penjualan</h2>
                </div>
            </div>
        </div>
       




<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ["Element", "Jumlah", { role: "style" } ],
      ["Dikemas", {{$dikemas}}, "#b87333"],
      ["Dikirim", {{$dikirim}}, "silver"],
      ["Selesai", {{$selesai}}, "gold"],
    //   ["Platinum", 21.45, "color: #e5e4e2"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      title: "Grafik Status Penjualan",
      width: 600,
      height: 400,
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
}
</script>
<div id="columnchart_values" style="width: 900px; height: 100px; margin-left:30px;"></div>







@endsection

