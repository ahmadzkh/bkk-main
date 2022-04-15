@extends('templates.main')

@section('title', 'BKK 1 | Detail Mitra')

@section('css')
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
<script src="{{ asset('/assets/js/jquery.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/assets/css/mitra-detail.css') }}">
@endsection

@section('container')
    <!-- header -->
    <section id="header" class="bg-biru pb-5">
        @include('partials.navbar')
        <div class="container header-wrap d-flex flex-column align-items-center justify-content-end" style="height: 200px">
            <div class="row">
                <div class="col text-center text-lg-start">
                    <span class="header-sub ">
                        Detail
                    </span>
                    <br>
                    <span class="header-text">
                        Mitra
                    </span>
                </div>
            </div>
        </div>
    </section>
    <!-- profil -->
    <section id="content">
        <div class="container">
            <div class="col box mt-5">
                <div class="box-sampul">
                </div>
                <img src="{{ asset($urlImg.$mitra->foto) }}" alt="" class="profil-img img-fluid" draggable="false">
                <div class="box-wrap pb-5">
                    <!-- nama -->
                    <div class="box-title">
                        {{ $mitra->jenis }}. {{ $mitra->nama }}
                    </div>
                    <div class="category text-black-50">
                        {{ $mitra->kategori }}
                    </div>
                    <div class="alamat">
                        <i class="bi bi-geo-alt-fill me-2"></i>{{ $mitra->wilayah }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- reviews -->
    <section id="reviews">
        <div class="container">
            <div class="sub-title">Employee Reviews</div>
            <div class="row g-4">
                <div class="col-6 col-lg-4">
                    <div class="box-review">
                        <div class="box-text p-4">
                            “Bekerja disini mendapatkan pengalaman
                            yang seru dan uang yang banyak. Dan
                            juga pekerjaannya tidak terlalu berat
                            seperti kerja rodi.”
                        </div>
                        <div class="box-footer d-flex justify-content-end align-items-center position-relative">
                            <img src="{{ asset('/assets/img/default-profile.png') }}" alt="" class="img-fluid img-review" draggable="false">
                            <div class="review-name pe-3 text-white">Sultan Jawadi</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4">
                    <div class="box-review">
                        <div class="box-text p-4">
                            “Bekerja disini mendapatkan pengalaman
                            yang seru dan uang yang banyak. Dan
                            juga pekerjaannya tidak terlalu berat
                            seperti kerja rodi.”
                        </div>
                        <div class="box-footer d-flex justify-content-end align-items-center position-relative">
                            <img src="{{ asset('/assets/img/default-profile.png') }}" alt="" class="img-fluid img-review" draggable="false">
                            <div class="review-name pe-3 text-white">Sultan Jawadi</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4">
                    <div class="box-review">
                        <div class="box-text p-4">
                            “Bekerja disini mendapatkan pengalaman
                            yang seru dan uang yang banyak. Dan
                            juga pekerjaannya tidak terlalu berat
                            seperti kerja rodi.”
                        </div>
                        <div class="box-footer d-flex justify-content-end align-items-center position-relative">
                            <img src="{{ asset('/assets/img/default-profile.png') }}" alt="" class="img-fluid img-review" draggable="false">
                            <div class="review-name pe-3 text-white">Sultan Jawadi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- overview -->
    <section id="overview">
        <div class="container">
            <div class="sub-title">Overview</div>
            <div class="row">
                <div class="col">
                    <div class="box-overview p-5">
                        <div class="fs-2 fw-bold mb-4">Overview</div>
                        <div class="overview-text mb-4">
                            {!! $mitra->overview !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-title">Highlight</div>
            <div class="row overview-images mt-5 p-4">
                <div class="row">
                    <div class="col-12 col-lg-6 p-4">
                        <div class="row">
                            <div class="col-9 d-flex flex-column justify-content-center">
                                <div class="fw-bold fs-4">Lokasi Pusat</div>
                                {{ $mitra->wilayah }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-4">
                        <div class="row">
                            <div class="col-9 d-flex flex-column justify-content-center">
                                <div class="fw-bold fs-4">Spesialisasi</div>
                                {{ $mitra->kategori }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-lg-6 p-4">
                        <div class="row">
                            <div class="col-9 d-flex flex-column justify-content-center">
                                <div class="fw-bold fs-4">Nomor Telepon</div>
                                {{ $mitra->no_telp }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-4">
                        <div class="row">
                            <div class="col-9 d-flex flex-column justify-content-center">
                                <div class="fw-bold fs-4">Website</div>
                                <a href="{{ $mitra->website }}" class="text-decoration-none text-link-black">{{ $mitra->nama }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- gallery -->
    <section id="gallery">
        <div class="container">
            <div class="sub-title">Gallery</div>
            <div class="row g-2">
                <div class="col-lg-7">
                    <div class="image1">
                        <img src="{{ asset('/assets/img/simple.jpg') }}" alt="" class="img-fluid" draggable="false">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="image2">
                                <img src="{{ asset('/assets/img/simple.jpg') }}" alt="" class="img-fluid" draggable="false">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="image3">
                                <img src="{{ asset('/assets/img/simple.jpg') }}" alt="" class="img-fluid" draggable="false">
                            </div>
                        </div>
                        <div class="col">
                            <div class="image4">
                                <img src="{{ asset('/assets/img/simple.jpg') }}" alt="" class="img-fluid" draggable="false">
                            </div>
                        </div>
                        <div class="col">
                            <div class="image5">
                                <img src="{{ asset('/assets/img/simple.jpg') }}" alt="" class="img-fluid" draggable="false">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@include('partials.footer')

@endsection
@section('script')
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
@endsection
