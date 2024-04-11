@extends('dashboards.layouts.app')
@section('title', 'Dashboard')
@section('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
@endsection
@section('content')

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard Analytics</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- page statustic card start -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-yellow">{{ $total }} {{ trans('page.currency') }}</h4>
                                    <h6 class="text-muted m-b-0">Tổng hóa đơn</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-bar-chart-2 f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-yellow">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0"></p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-up text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-green">290+</h4>
                                    <h6 class="text-muted m-b-0">Lượt Truy Cập</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-file-text f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-green">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0"></p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-up text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-red">{{ $count_cart }}</h4>
                                    <h6 class="text-muted m-b-0">Đơn Hàng</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-calendar f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-red">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0"></p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-down text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-blue">{{ $productCount }}</h4>
                                    <h6 class="text-muted m-b-0">Số lượng sản phẩm</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-thumbs-down f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0"></p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-down text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-footer ">
                            <div class="row align-items-center">
                                <canvas id="myChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-footer ">
                            <div class="row align-items-center">
                                <canvas id="myLineChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- page statustic card end -->
        </div>

    </div>
    <!-- [ Main Content ] end -->
@endsection
@php
    $accessData = [
        ['date' => '2023-09-01', 'visitors' => 100],
        ['date' => '2023-09-02', 'visitors' => 150],
        ['date' => '2023-09-03', 'visitors' => 120],
        ['date' => '2023-09-04', 'visitors' => 90],
        ['date' => '2023-09-05', 'visitors' => 110],
        ['date' => '2023-09-06', 'visitors' => 130],
        ['date' => '2023-09-07', 'visitors' => 145],
        ['date' => '2023-09-08', 'visitors' => 155],
        ['date' => '2023-09-09', 'visitors' => 165],
        ['date' => '2023-09-10', 'visitors' => 180],
        ['date' => '2023-09-11', 'visitors' => 170],
        ['date' => '2023-09-12', 'visitors' => 160],
        ['date' => '2023-09-13', 'visitors' => 140],
        ['date' => '2023-09-14', 'visitors' => 130],
        ['date' => '2023-09-15', 'visitors' => 120],
        ['date' => '2023-09-16', 'visitors' => 110],
        ['date' => '2023-09-17', 'visitors' => 100],
        ['date' => '2023-09-18', 'visitors' => 95],
        ['date' => '2023-09-19', 'visitors' => 110],
        ['date' => '2023-09-20', 'visitors' => 125],
        ['date' => '2023-09-21', 'visitors' => 140],
        ['date' => '2023-09-22', 'visitors' => 150],
        ['date' => '2023-09-23', 'visitors' => 160],
        ['date' => '2023-09-24', 'visitors' => 170],
        ['date' => '2023-09-25', 'visitors' => 180],
        ['date' => '2023-09-26', 'visitors' => 190],
        ['date' => '2023-09-27', 'visitors' => 200],
        ['date' => '2023-09-28', 'visitors' => 210],
        ['date' => '2023-09-29', 'visitors' => 220],
        ['date' => '2023-09-30', 'visitors' => 230],
    ];
@endphp
@section('script')
    <script>
        var ctx = document.getElementById('myLineChart').getContext('2d');

        var dates = [];
        var visitors = [];

        @foreach ($accessData as $data)
            dates.push('{{ $data['date'] }}');
            visitors.push('{{ $data['visitors'] }}');
        @endforeach

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Số lượng truy cập',
                    data: visitors,
                    borderColor: 'rgb(75, 192, 192)',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var dates = [];
        var totals = [];

        @foreach ($order as $order)
            dates.push('{{ $order->created_at }}');
            totals.push('{{ $order->total }}');
        @endforeach

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Số tiền',
                    data: totals,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
