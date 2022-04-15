@extends('templates.main')
@section('title', 'BKK 1 | Dashboard Admin')
@section('css')
    <link rel="stylesheet" href="{{asset ('/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset ('/assets/css/styleMitra.css')}}">

    <style>
        .title-page h1.fw-bold {
            margin-bottom: 60px;
        }
        /* STYLING DETAIL WRAPPER */
        .detail-outer-wrapper .header {
            border-radius: 15px 15px 0px 0px;
            height: 250px;
            background-image: linear-gradient(to right, #2e51d1, #9cb0f0);
        }
        .detail-outer-wrapper .content .prestasi div.img div {
            width: 100px;
            height: 100px;
            background-color: rgb(165, 163, 163);
        }
        .detail-outer-wrapper .content div.tools div {
            width: 30px;
            height: 30px;
            color: #fff;
        }
        .detail-outer-wrapper .content div.tools div:nth-child(1) {
            background: rgb(242, 180, 46);
        }
        .detail-outer-wrapper .content div.tools div:nth-child(2) {
            background: rgb(242, 42, 42);
        }
        .detail-outer-wrapper .content .img {
            height: 300px;
            width: 100%;
        }
        .detail-outer-wrapper .content .img .big-img div,
        .detail-outer-wrapper .content .img .small-img div {
            height: 100%;
        }
        .detail-outer-wrapper .content .img .big-img div div {
            height: 100%;
            width: 100%;
            background-color: rgb(202, 202, 202);
        }
        .detail-outer-wrapper .content .img .small-img div div {
            height: 100%;
            background-color: rgb(202, 202, 202);
        }
        .detail-outer-wrapper .content .row {
            --bs-gutter-x: 0px;
        }
        /* CUSTOMIZING GALLERY */
        .owl-carousel div div.item {
            height: 200px;
            width: 200px;
        }
    </style>
@endsection
@section('container')
    <div class="main-page">
        <!-- SIDEBAR -->
        @include('partials.sidebar-admin')

        <!-- IMAGE WAVES -->
        <img src="{{asset ('/assets/img/wave2.svg')}}" class="position-absolute waves">

        <div class="content-outer-wrapper mx-auto">
            <div class="py-3 content-wrapper">
                <!-- TITLE -->
                <div class="title-back">
                    <a href="{{ URL::previous() }}" class="d-flex align-items-center text-decoration-none text-white">
                        <i class='bx bx-left-arrow-alt'></i>Back
                    </a>
                </div>
                <div class="title-page text-white my-5">
                    <h1 class="fw-light">Detail</h1>
                    <h1 class="fw-bold">Mitra</h1>
                </div>

                <!-- CONTENT -->
                <div class="detail-outer-wrapper shadow-custom-2 rounded-20 mx-0 mx-md-5 mb-5">
                    <div class="header d-flex align-items-center">
                        <!-- HEADER IMAGE DAN BANNER -->
                        <div class="img rounded-circle ms-5">
                            <img src="{{asset ('/assets/img/' . $mitra->foto)}}" alt="logo" width="200px">
                        </div>
                    </div>
                    <!-- ISI DATA-DATANYA -->
                    <div class="content py-3 px-5">
                        <div class="mb-4 d-flex justify-content-between">
                            <div>
                                <h2 class="fw-900">{{$mitra->jenis}}. {{$mitra->nama}} <i class='bx bxs-badge-check text-primary align-middle'></i></h2>
                            </div>
                            <div class="tools d-flex">
                                <div class="rounded-15 d-flex justify-content-center align-items-center me-1">
                                    <a href="{{route('admin.mitra.edit', encrypt($mitra->id_mitra))}}" class="text-white"><i class='bx bxs-edit'></i></a>
                                </div>
                                <div class="rounded-15 d-flex justify-content-center align-items-center">
                                    <button class="rounded-15" onclick="deleteData('{{ $mitra->id_mitra}}')" type="submit" data-toggle="tooltip" data-placement="bottom" title="Hapus Data Alumni"><i class="bx bx-trash-alt text-danger"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5 class="fw-bold mb-1">Tentang</h5>
                            @if ($mitra->overview === null)
                                <p>-</p>
                            @endif
                            {{$mitra->overview}}
                        </div>
                        <div class="row justify-content-between mb-4">
                            <div class="col-5">
                                <h5 class="fw-bold mb-1">Visi</h5>
                                @if ($mitra->visi === null)
                                <p>-</p>
                                @endif
                                {{$mitra->visi}}
                            </div>
                            <div class="col-5">
                                <h5 class="fw-bold mb-1">Misi</h5>
                                @if ($mitra->misi === null)
                                <p>-</p>
                                @endif
                                {{$mitra->misi}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Industri</h5>
                                <p>{{$mitra->kategori}}</p>
                            </div>
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Website</h5>
                                <a href="{{$mitra->website}}" class="text-decoration-none">{{$mitra->website}}</a>
                            </div>
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Lokasi</h5>
                                <p>{{$mitra->wilayah}}</p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Email</h5>
                                <p>{{$mitra->user->email}}</p>
                            </div>
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Nomor Perusahaan</h5>
                                <p>{{$mitra->no_telp}}</p>
                            </div>
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Tahun Bergabung</h5>
                                <p>{{\Carbon\Carbon::parse($mitra->created_at)->format('Y')}}</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5 class="fw-bold mb-1">Alamat</h5>
                            @if ($mitra->kantor_pusat === null)
                                <p>-</p>
                            @endif
                            {{$mitra->kantor_pusat}}
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col">
                                <h5 class="fw-bold mb-1">Level</h5>
                                <p>Mitra</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Lowongan Dibuat</h5>
                                <p>0</p>
                            </div>
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Lowongan Aktif</h5>
                                <p>0</p>
                            </div>
                            <div class="col-4">
                                <h5 class="fw-bold mb-1">Lowongan Selesai</h5>
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- KANTOR --}}
                <div class="detail-outer-wrapper shadow-custom-2 rounded-20 mx-0 mx-md-5 mb-5">
                    <!-- ISI DATA-DATANYA -->
                    <div class="content py-4 px-5">
                        <div>
                            <h3 class="fw-900">KANTOR {{$mitra->nama}}</h3>
                            <p>Daftar Kantor yang sudah terdaftar</p>
                        </div>
                        <table class="table table-borderless overflow-scroll">
                            <thead>
                                <tr class="row justify-content-between">
                                    <th class="col-1" scope="col">#</th>
                                    <th class="col-5" scope="col">Alamat</th>
                                    <th class="col" scope="col">Kota</th>
                                    <th class="col" scope="col">Nomor Telepon</th>
                                    <th class="col-2" scope="col">~</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kantor as $id => $item)
                                @php
                                    $id++
                                @endphp
                                <tr class="row justify-content-between">
                                    <td class="col-1">{{$id}}</td>
                                    <td class="col-5">{{$item->alamat}}</td>
                                    <td class="col">{{$item->wilayah}}</td>
                                    <td class="col">{{$item->no_telp}}</td>
                                    <td class="col-2" class="d-flex m-0 p-0">
                                        <a href="" class="btn btn-warning rounded-15 fw-bold" data-toggle="tooltip" data-placement="bottom" title="Ubah Data Kantor">
                                            <i class='bx bxs-edit text-white align-middle'></i>
                                        </a>
                                        <button  class="btn btn-danger rounded-15 fw-bold" onclick="deleteData('{{$item->id_kantor}}')" type="submit" data-toggle="tooltip" data-placement="bottom" title="Hapus Data Kantor"><i class="bx bxs-trash-alt text-white align-middle"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- GALLERY --}}
                <div class="gallery mx-0 mx-md-5">
                    <h2 class="fw-900 mb-2">Gallery</h2>
                    <div class="row owl-carousel">
                        <div class="col-4 col-md-2 mb-2">
                            <div class="item overflow-hidden d-flex justify-content-center align-items-center">
                                <img src="{{asset ('/assets/img/')}}" class="rounded-15">
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-2">
                            <div class="item overflow-hidden d-flex justify-content-center align-items-center">
                                <img src="{{asset ('/assets/img/')}}" class="rounded-15">
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-2">
                            <div class="item overflow-hidden d-flex justify-content-center align-items-center">
                                <img src="{{asset ('/assets/img/')}}" class="rounded-15">
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-2">
                            <div class="item overflow-hidden d-flex justify-content-center align-items-center">
                                <img src="{{asset ('/assets/img/')}}" class="rounded-15">
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-2">
                            <div class="item overflow-hidden d-flex justify-content-center align-items-center">
                                <img src="{{asset ('/assets/img/')}}" class="rounded-15">
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-2">
                            <div class="item overflow-hidden d-flex justify-content-center align-items-center">
                                <img src="{{asset ('/assets/img/')}}" class="rounded-15">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- OWLCAROUSEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                margin: 10,
                loop: true,
                autoWidth: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        })
    </script>

    <!-- SWEETALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteData(id) {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data tidak dapat dikembalikan setelah dihapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('/ad/al/delete') }}" + '/' + id, ///ubah
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
                                    window.location.replace("http://127.0.0.1:8000/ad/mt/list"); ///ubah
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
                        swal("File tidak dihapus!");
                    }
                });
        }
    </script>
@endsection
