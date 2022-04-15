@extends('templates.main')
@section('title', 'BKK 1 | Dashboard Admin')
@section('css')
<link rel="stylesheet" href="{{asset ('/assets/css/style.css')}}">
<style>
        .title-page h1.fw-bold {
            margin-bottom: 130px;
        }

        .alumni-graph .row {
            margin-right: 0px!important;
        }

        .alumni-graph .graph-item .item {
            height: 150px;
        }

        .alumni-graph .graph-item div p:nth-child(2) {
            margin-top: -15px;
            font-weight: 900;
            font-size: 58px;
        }
</style>
@endsection
@section('container')
<div class="main-page">
    <!-- SIDEBAR -->
    @include('partials.sidebar-admin')
    <img src="{{asset ('/assets/img/wave2.svg')}}" class="position-absolute waves">

    <div class="content-outer-wrapper mx-auto">
        <div class="py-3 content-wrapper">
            <!-- TITLE -->
            <div class="title-page text-white my-5">
                <h1 class="fw-light">Dashboard</h1>
                <h1 class="fw-bold">Admin</h1>
            </div>

            <div class="alumni-table">
                <!-- GRAFIX BATANG -->
                <div class="alumni-graph">
                    <div class="row mb-3">
                        <div class="bg-white graph-item col">
                            <div class="item rounded-20 p-3 shadow-custom-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Alumni</p>
                                    <a href="{{route('admin.alumni.list')}}" class="btn btn-primary rounded-20">Lihat Data</a>
                                </div>
                                <p class="text-center">{{$count_alumni}}</p>
                            </div>
                        </div>
                        <div class="bg-white graph-item col">
                            <div class="item rounded-20 p-3 shadow-custom-2">
                                <p>Berkerja</p>
                                <p class="text-center">{{$count_alumniKerja}}</p>
                            </div>
                        </div>
                        <div class="bg-white graph-item col">
                            <div class="item rounded-20 p-3 shadow-custom-2">
                                <p>Kuliah</p>
                                <p class="text-center">{{$count_alumniKuliah}}</p>
                            </div>
                        </div>
                        <div class="bg-white graph-item col">
                            <div class="item rounded-20 p-3 shadow-custom-2">
                                <p>Wirausaha</p>
                                <p class="text-center">{{$count_alumniUsaha}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="pe-3">
                            <div class="bg-white rounded-20 p-3 shadow-custom-2">
                                <div class="d-flex align-items-center mb-3">
                                    <h2 class="fw-700 me-3 mb-0">Grafik Karir Alumni</h2>
                                    <a href="{{route('admin.alumni')}}" class="btn btn-primary rounded-20">Lihat Penelusuran
                                        Alumni</a>
                                </div>
                                <canvas id="myChart" height="100px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- BOOTSTRAP 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- CHART JS 3.5.1 -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var cData = JSON.parse(`<?php echo $chart_data; ?>`);

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cData.label,
                datasets: [{
                    label: 'Bekerja',
                    data: [32, 43, 3, 7, 10, 32],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }, {
                    label: 'Kuliah',
                    data: [12, 32, 5, 5, 2, 3],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }, {
                    label: 'Wirausaha',
                    data: [12, 32, 5, 5, 2, 3],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
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
