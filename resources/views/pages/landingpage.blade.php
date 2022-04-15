@extends('templates.main')

@section('title', 'BKK | SMKN 1 KOTA BEKASI')
@section('css')
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
@endsection

@section('container')
@auth
@if (auth()->user()->level_id === 'LVL00002')
<div id="popup">
    <div class="popup-box">
        <div class="row">
            <div class="col">
                <div class="fw-bold text-center fs-4">
                    Sebagai Apa Kamu Sekarang?
                </div>
            </div>
        </div>
        <form action="">
            <div class="row h-100 mt-4">
                <div class="col position-relative">
                    <input type="radio" class="radio" id="mahasiswa" name="status" value="mahasiswa" required />
                    <label for="mahasiswa">
                        <div class="curstat-box col w-100">
                            <img src="../assets/student.png" alt="" class="img-fluid" />
                            <div class="text-center fw-bold fs-5">Mahasiswa</div>
                        </div>
                    </label>
                </div>
                <div class="col position-relative">
                    <input type="radio" class="radio" id="karyawan" name="status" value="karyawan" required />
                    <label for="karyawan">
                        <div class="curstat-box col w-100">
                            <img src="../assets/karyawan.png" alt="" class="img-fluid" />
                            <div class="text-center fw-bold fs-5">Karyawan</div>
                        </div>
                    </label>
                </div>
                <div class="col position-relative">
                    <input type="radio" class="radio" id="wirausaha" name="status" value="wirausaha" required />
                    <label for="wirausaha">
                        <div class="curstat-box col w-100">
                            <img src="../assets/wirausaha.png" alt="" class="img-fluid" />
                            <div class="text-center fw-bold fs-5">Wirausaha</div>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row mt-3">
                <input type="text" name="desc" class="form-control" required />
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary mt-3 fw-bold">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endauth

<nav class="navbar py-4 navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand bold" href="{{route('home')}}">
            <img src="{{asset ('assets/img/imp/logoobkk.png')}}" alt="bkk_logo" style="width: 120px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav medium text-center mx-auto">
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'home') ? 'active' : ''}}" aria-current="page"
                        href="{{route('home')}}">Home</a>
                </li>
                @auth
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'alumni') ? 'active' : ''}}"
                        href="{{route('bkk.alumni')}}">Alumni</a>
                </li>
                @endauth
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'vacancy') ? 'active' : ''}}" href="{{route('bkk.loker')}}">Job
                        Vacancy</a>
                </li>
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'partner') ? 'active' : ''}}"
                        href="{{route('bkk.mitra')}}">Partners</a>
                </li>
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'information') ? 'active' : ''}}"
                        href="{{(route('bkk.informasi'))}}">Information</a>
                </li>
            </ul>
            @auth
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" style="border-radius: 10px" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (auth()->user()->username == null)
                            {{ auth()->user()->email }}
                            @else
                            <i class="bi bi-person-circle me-1"></i> {{auth()->user()->username}}
                            @endif
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @if (auth()->user()->level_id === 'LVL00001')
                            <li><a class="dropdown-item" href="{{route('admin.profile')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('admin.home')}}">Dashboard</a></li>
                            @endif
                            @if (auth()->user()->level_id === 'LVL00002')
                            <li><a class="dropdown-item" href="{{route('alumni.profile')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('alumni.rekomendasi')}}">Rekomendation</a></li>
                            @endif
                            @if (auth()->user()->level_id === 'LVL00003')
                            <li><a class="dropdown-item" href="{{route('mitra.profile')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('mitra.home')}}">Dashboard</a></li>
                            @endif
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit"><i
                                        class="bx bx-log-out-circle me-3"></i>Logout</button>
                            </form>
                        </ul>
                    </div>
                </li>
            </ul>
            @else
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{route('login')}}" class="btn-login text-decoration-none semibold">Login</a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>
<!-- hero -->
<section class="banner">
    <div class="container position-relative">
        <img src="{{asset ('assets/img/hero2.png')}}" alt="" class="hero2">
        <div class="row">
            <div class="col-lg-7 text-white d-flex flex-column justify-content-center banner-kanan">
                <div class="row">
                    <div class="col text-banner black">
                        Bursa Kerja Khusus <br> SMKN 1 Kota Bekasi
                    </div>
                    <div class="row">
                        <div class="col d-block">
                            <a href="{{route('bkk.about')}}" class="btn-banner bold">
                                More About Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 bumi">
                <img src="{{asset ('assets/img/bumi.png')}}" alt="bumi" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<!-- partner -->
<section class="partners" id="partner-section">
    <div class="fs-4 text-center bold">
        Our Partners
    </div>
    <div class="container mt-2 mt-lg-5">
        <div class="row">
            <div class="col-6 col-lg-3 d-flex justify-content-center">
                <a href="#">
                    <img src="{{asset ('assets/img/daihatsu.png')}}" alt="" class="partner-img">
                </a>
            </div>
            <div class="col-6 col-lg-3 d-flex justify-content-center">
                <a href="#">
                    <img src="{{asset ('assets/img/toyota.png')}}" alt="" class="partner-img">
                </a>
            </div>
            <div class="col-6 col-lg-3 d-flex justify-content-center">
                <a href="#">
                    <img src="{{asset ('assets/img/yamaha.png')}}" alt="" class="partner-img">
                </a>
            </div>
            <div class="col-6 col-lg-3 d-flex justify-content-center">
                <a href="#">
                    <img src="{{asset ('assets/img/hyundai.png')}}" alt="" class="partner-img">
                </a>
            </div>
        </div>
    </div>
</section>
<!-- about -->
<section id="about" class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-title black">
                    BKK SMK NEGERI 1 KOTA BEKASI
                </div>
                <div class="about-desc">
                    Bursa Kerja Khusus (BKK) adalah sebuah lembaga yang dibentuk di
                    Sekolah Menengah Kejuruan Negeri dan Swasta, sebagai unit
                    pelaksana yang memberikan pelayanan dan informasi lowongan kerja,
                    pelaksana pemasaran, penyaluran dan penempatan tenaga kerja,
                    merupakan mitra Dinas Tenaga Kerja dan Transmigrasi.
                </div>
                <div class="about-btn">
                    <a href="#">See More
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: #2041BB;">
                            <path
                                d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-6">
                        <img src="{{asset ('assets/img/target.png')}}" alt="" class="about-img">
                        <div class="img-text">
                            <div class="img-title black">
                                Fokus Pada Target
                            </div>
                            <div class="img-title-desc medium">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, deserunt.
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <img src="{{asset ('assets/img/poto.png')}}" alt="" class="about-img">
                        <div class="img-text">
                            <div class="img-title black">
                                Fleksibel
                            </div>
                            <div class="img-title-desc medium">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, deserunt.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-6">
                        <img src="{{asset ('assets/img/envelope.png')}}" alt="" class="about-img">
                        <div class="img-text">
                            <div class="img-title black">
                                Terpercaya
                            </div>
                            <div class="img-title-desc medium">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, deserunt.
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <img src="{{asset ('assets/img/folder.png')}}" alt="" class="about-img">
                        <div class="img-text">
                            <div class="img-title black">
                                Terorganisir
                            </div>
                            <div class="img-title-desc medium">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, deserunt.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- content -->
<section id="content1" class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 position-relative">
                <img src="{{asset ('assets/img/vector1.png')}}" alt="" class="content-img-bg">
                <img src="{{asset ('assets/img/ban1.png')}}" alt="" class="content-img img-fluid">
            </div>
            <div class="col-lg-6 d-flex justify-content-center flex-column">
                <div class="about-title black">
                    Mempermudah Alumni Mencari Kerja
                </div>
                <div class="about-desc">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident fuga quo consectetur sit
                    facilis quis consequatur quae laudantium optio perspiciatis!
                </div>
                <div class="about-btn">
                    <a href="{{ route('bkk.loker') }}">See More
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: #2041BB;">
                            <path
                                d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- content 2 -->
<section id="content2" class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-center flex-column">
                <div class="about-title black">
                    Dipercaya Banyak Perusahaan
                </div>
                <div class="about-desc">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident fuga quo consectetur sit
                    facilis quis consequatur quae laudantium optio perspiciatis!
                </div>
                <div class="about-btn">
                    <a href="{{ route('bkk.mitra') }}">See More
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: #2041BB;">
                            <path
                                d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 position-relative">
                <img src="{{asset ('assets/img/vector2.png')}}" alt="" class="content-img-bg2">
                <img src="{{asset ('assets/img/ban2.png')}}" alt="" class="content-img img-fluid">
            </div>
        </div>
    </div>
</section>
<!-- berita -->
<section id="berita" class="">
    <div class="container">
        <div class="row">
            <div class="berita-title black">Artikel Terbaru Dari BKK</div>
        </div>
        <div class="row g-3 mt-3">
            @foreach ($news as $new)
            <div class="col-lg-4">
                <a href="#" class="text-decoration-none a-info">
                    <div class="box-info">
                        <div class="info-cover">
                            <img src="{{ asset('/assets/img/pisang.jpg') }}" alt="banner" class="img-fluid" />
                        </div>
                        <div class="p-3 judul-info fw-bold text-black">
                            {{ $new->title }}
                        </div>
                        <div class="row p-3 text-black-50">
                            <div class="col">
                                <div class="small">Administrator BKK</div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <div class="small">
                                    <i class="bi bi-calendar me-1"></i> {{
                                    \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- footer -->
<!-- footer -->
<section id="footer">
    <div class="container">
        <div class="row footer d-flex justify-content-center">
            <div class="col-lg-3">
                <img src="{{asset ('/assets/img/imp/logobkkbiru.png')}}" alt="">
                <a href="#" class="d-block mt-4 medium text-decoration-none">
                    info@smkn1kotabekasi.sch.id
                </a>
                <div class="medium">
                    0821-2790-7676
                </div>

            </div>
            <div class="col-lg-3 mt-5 mt-lg-0">
                <div class="footer-title extrabolds">
                    About Us
                </div>
                <div class="footer-text mt-3">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-title extrabolds">
                    About Us
                </div>
                <div class="footer-text mt-3">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-title extrabolds">
                    About Us
                </div>
                <div class="footer-text mt-3">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none text-black-50 semibold">Lorem Ipsum</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col text-center text-black-50">
                Copyright &copy; <span class="fw-bold">RPL SMKN 1 Kota Bekasi</span>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>


<script src="{{asset('/assets/js/jquery.js')}}"></script>
<script src="{{asset ('/assets/owlcarousel/dist/owl.carousel.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#popup").css("display", "none");
        // setTimeout(() => {
        //     $("#popup").css("display", "flex");
        // }, 10000);
        $(".owl-carousel").owlCarousel({
            nav: true,
            loop: true,
            margin: 150,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                700: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            },
            autoplay: true,
        });
    });
</script>
@endsection
