@extends('templates.main')

@section('title', 'Dashboard Utama | Mitra')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/styleMitra.css') }}">

    <style>
        /* CUSTOMIZING GRAFIX */
        .graph-item-wrapper div:nth-child(2) {
            font-size: 50px;
        }
        .row.small-graph {
            --bs-gutter-x: 0;
        }
        /* COSTUMIZING NOTIFICATION */
        .notification-wrapper .notif-item .notif-img {
            width: 50px;
            height: 50px;
            background: #3ad6e7;
        }
        .notification-wrapper .notif-item .notif-content p {
            margin: 0;
        }
        @media only screen and (max-width: 768px) {
            /* NOTIF */
            .notification-wrapper .notif-item .notif-img {
                width: fit-content;
                height: fit-content;
            }
            .notification-wrapper .notif-item .notif-img i {
                font-size: 10px;
                padding: 5px;
            }
        }
    </style>
@endsection

@section('container')
    @include('partials.navbar-mitra')

    <div class="main-page">
        @include('partials.sidebar-mitra')

        {{-- <img src="/assets/img/wave2.svg" class="position-absolute waves"> --}}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="position-absolute waves"
            preserveAspectRatio="none">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,288L60,282.7C120,277,240,267,360,234.7C480,203,600,149,720,149.3C840,149,960,203,1080,213.3C1200,224,1320,192,1380,176L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg>

        <div class="container-lg py-3 content-wrapper">
            <!-- TITLE -->
            <div class="title-page text-white mb-5">
                <h1 class="fw-light">Main</h1>
                <h1 class="fw-bold">Dashboard</h1>
            </div>

            <div class="welcome-admin text-white mb-5">
                <!-- WELCOMING TEXT -->
                <h4>Hello, Welcome Back!</h4>
            </div>

            <!-- INFORMATION ABOUT DATAS -->
            <div class="row small-graph mb-3">
                <div class="col-md col-6 small-graph-item p-1">
                    <div class="graph-item-wrapper p-3 shadow rounded-20 bg-white">
                        <div class="">Rekomendasi Alumni</div>
                        <div class="text-center fw-900">102</div>
                    </div>
                </div>
                <div class="col-md col-6 small-graph-item p-1">
                    <div class="graph-item-wrapper p-3 shadow rounded-20 bg-white">
                        <div class="">Alumni Berkerja</div>
                        <div class="text-center fw-900">54</div>
                    </div>
                </div>
                <div class="col-md col-6 small-graph-item p-1">
                    <div class="graph-item-wrapper p-3 shadow rounded-20 bg-white">
                        <div class="">Lowongan Dibuat</div>
                        <div class="text-center fw-900">{{ $lokerCreated }}</div>
                    </div>
                </div>
                <div class="col-md col-6 small-graph-item p-1">
                    <div class="graph-item-wrapper p-3 shadow rounded-20 bg-white">
                        <div class="">Lowongan Aktif</div>
                        <div class="text-center fw-900">{{ $lokerActive }}</div>
                    </div>
                </div>
            </div>

            <div class="notification-wrapper p-3 rounded-20 shadow">
                <!-- NOTIFIKASI DARI YANG DILAKUIN -->
                <div class="mb-2">
                    <h2 class="d-inline align-middle me-2 fw-bold">Notifikasi</h2><span class="badge bg-danger">20+</span>
                </div>
                <div class="my-4">
                    <!-- NOTIFIKASI ITEMNYA -->
                    @foreach ($rekomend as $val)
                        <div class="notif-item d-flex justify-content-between my-2">
                            <div class="d-flex">
                                <div class="notif-img rounded-circle d-flex justify-content-center align-items-center"><i
                                        class='bx bxs-briefcase-alt-2 text-white' style="font-size: 20px;"></i>
                                </div>
                                <div class="notif-content mx-2">
                                    <p class="title fw-bold">{{ $val->judul }}</p>
                                    <p class="content fw-bold">{{ $val->text }}</p>
                                </div>
                            </div>
                            <div class="notif-date align-self-center mx-2 fw-bold">
                                {{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</div>
                        </div>
                    @endforeach
                </div>
                <!-- PINDAH KE NOTIFKASI LEBIH LENGKAP -->
                <div class="text-center">
                    <a href="/mt/notif" class="btn btn-primary rounded-20">More</a>
                </div>
            </div>
        </div>
    </div>
@endsection
