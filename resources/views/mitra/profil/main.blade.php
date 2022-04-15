@extends('templates.main')

@section('title', 'BKK 1 | Profile')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/styleMitra.css') }}">

    <style>
        /* STYLING DETAIL WRAPPER */
        .rounded-custom {
            border-radius: 30px;
        }
        .detail-wrapper .header {
            border-radius: 30px 30px 0px 0px;
            height: 250px;
            margin-bottom: 70px;
            background-image: linear-gradient(to right, #2e51d1, #9cb0f0);
        }
        .detail-wrapper .content .prestasi div.img div {
            width: 100px;
            height: 100px;
            background-color: rgb(165, 163, 163);
        }
        .detail-wrapper .content .pelamar a.btn {
            font-size: 20px;
        }
        .detail-wrapper .header .img {
            background: rgb(220, 219, 219);
            height: 200px;
            width: 200px;
            border: 7px solid #fff;
            top: 50%;
            left: 3%;
        }
        /* CUSTOMIZE GALLERY */
        .gallery .img {
            height: 400px;
            width: 100%;
        }
        .gallery .img .big-img div,
        .gallery .img .small-img div {
            height: 100%;
        }
        .gallery .img .big-img div div {
            height: 100%;
            width: 100%;
            background-color: rgb(202, 202, 202);
        }
        .gallery .img .small-img div div {
            height: 100%;
            background-color: rgb(202, 202, 202);
        }
        .row {
            --bs-gutter-x: 0px;
        }
        @media only screen and (max-width: 768px) {
            /* PROFIL DATA */
            .detail-wrapper .header {
                height: 120px;
                margin-bottom: 50px;
            }
            .detail-wrapper .header .img {
                height: 120px;
                width: 120px;
                border: 4px solid #fff;
            }
        }
    </style>
@endsection

@section('container')
    @include('partials.navbar-mitra')

    <div class="main-page">
        @include('partials.sidebar-mitra')

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
                <h1 class="fw-bold">Profile</h1>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-15" role="alert">
                    <i class='bx bx-info-circle align-middle' style="font-size: 28px;"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-15" role="alert">
                    <i class='bx bx-info-circle align-middle' style="font-size: 28px;"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="detail-wrapper shadow bg-white shadow-custom-2 rounded-custom mb-5">
                <!-- HEADER -->
                <div class="header d-flex align-items-center position-relative">
                    <div
                        class="img overflow-hidden position-absolute rounded-circle d-flex justify-content-center align-items-center">
                        <img src="{{ $urlImg.$mitra->foto }}" width="200px">
                    </div>
                </div>
                <div class="content py-3 px-lg-5 px-3">
                    <div class="mb-4 d-flex justify-content-between">
                        <!-- TITLE NEWS -->
                        <div>
                            <h1 class="fw-900 mb-0">{{ $mitra->jenis }}. {{ $mitra->nama }}<i
                                    class='bx bxs-badge-check align-middle text-primary ms-1'></i></h1>
                            <h4 class="text-secondary">{{ $mitra->kategori }}</h4>
                            <h4 class="mt-3"></h4>
                            <h5 class="mt-3"><i
                                    class='bx bx-current-location align-middle me-1'></i>{{ $mitra->wilayah }}</h5>
                        </div>
                        <!-- TOOLS UNTUK EDIT DAN DELETE -->
                        <div class="tools d-flex">
                            <div class="rounded-15 d-flex justify-content-center align-items-start">
                                <a href="/mt/profil/ubah/{{ $mitra->id_mitra }}"
                                    class="btn btn-warning text-white rounded-15 fw-bold">Ubah</a>
                            </div>
                        </div>
                    </div>
                    <!-- CONTENT INFORMASI -->
                    <div class="mb-3">
                        <h4 class="fw-bold">Overview</h4>
                        <p align="justify">{!! $mitra->overview !!}</p>
                    </div>
                </div>
            </div>

            <div class="kantor-wrapper mb-4">
                <div class="rounded-custom bg-white shadow-custom-2 p-3 px-lg-5 px-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h2 class="fw-bold mb-0">Kantor</h2>
                            <p>Daftar kantor yang anda miliki.</p>
                        </div>
                        <div>
                            <a href="/mt/kantor/tambah" class="btn btn-primary rounded-15 fw-bold">Tambah</a>
                        </div>
                    </div>
                    <div class="overflow-auto">
                        <table class="table table-borderless overflow-scroll">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Kota</th>
                                    <th scope="col">No. Telp</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($kantor->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
                                    </tr>
                                @else
                                    @foreach ($kantor as $key => $item)
                                        @php
                                            $key++;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $key }}</th>
                                            <td><a href="#"
                                                    class="text-link-black text-decoration-none">{{ $item->id_kantor }}</a>
                                            </td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->wilayah }}</td>
                                            <td>{{ $item->no_telp }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td class="d-flex"><a href="/mt/kantor/ubah/{{ $item->id_kantor }}"
                                                    class="btn btn-warning rounded-15 fw-bold me-1"><i
                                                        class='bx bxs-edit align-middle'></i></a><button type="button"
                                                    class="btn btn-danger rounded-15 fw-bold"><i
                                                        class='bx bxs-trash-alt align-middle'
                                                        onclick="deleteData('{{ $item->id_kantor }}')"></i></button></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- SWEETALERT -->
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteData(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('/mt/kantor/hapus') }}" + '/' + id,
                            type: "POST",
                            data: {
                                '_method': 'POST'
                            },
                            success: function() {
                                swal({
                                    title: "Success!",
                                    text: "Redirecting in 2 seconds.",
                                    icon: "success",
                                    timer: 2000,
                                    button: true
                                }).then(function() {
                                    window.location.replace(
                                        "http://127.0.0.1:8000/mt/profil");
                                });
                            },
                            error: function() {
                                swal({
                                    title: 'Opps...',
                                    text: 'Ada masalah saat menghapus data.',
                                    icon: 'error',
                                    timer: '1500'
                                })
                            }
                        })
                    } else {
                        swal("Data tidak dihapus!");
                    }
                });
        }
    </script>
@endsection
