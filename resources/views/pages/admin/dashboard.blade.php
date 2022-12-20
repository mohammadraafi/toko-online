@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up"">
        <div class="container-fluid mt-5">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Laporan Penjualan</h2>
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
                                    {{ $customer }}
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
                                    Rp.{{ number_format($revenue) }}
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
                                    {{ $transactions }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-content section-dashboard-home mt-5 mb-5" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                    <h2 class="dashboard-title">Status Penjualan</h2>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Dikemas
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $dikemas }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Dikirim
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{$dikirim}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Selesai
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $selesai }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-content section-dashboard-home mt-5 mb-5" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <div class="card">
                    <div class="card-header">Grafik Pendapatan Bulanan</div>
                    <div class="card-body">
                        <div id="grafik"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
             var pendapatan = <?php echo json_encode($total_price); ?>;
        var bulan = <?php echo json_encode($bulan); ?>;
        Highcharts.chart('grafik', {
            title: {
                text: "Grafik pendapatan bulanan"
            },
            xAxis: {
                categories: bulan
            },
            yAxis: {
                title: {
                    text: "Nominal pendapatan bulanan"
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: "Nominal Pendapatan",
                data: pendapatan
            }]
        });
    </script>

@endsection
