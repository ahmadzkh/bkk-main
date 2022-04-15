@extends('templates.main')
@section('title', 'BKK 1 | Alumni')
@section('css')
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
<link rel="stylesheet" href="{{asset ('/assets/css/alumni.css')}}">
@endsection
@section('container')
<!-- navbar -->
<!-- header -->
<section id="header" class="bg-biru pb-5">
    @include('partials.navbar')
    <div class="container header-wrap d-flex flex-column align-items-center justify-content-end" style="height: 200px">
        <div class="row">
            <div class="col header-text">
                Alumni
            </div>
        </div>
        <div class="row">
            <div class="col search-bg">
                <form action="" method="GET" class="d-flex">
                    <button type="submit" class="header-btn">
                        <i class="bi bi-search text-white px-3"></i>
                    </button>
                    <input type="text" placeholder="Search.." class="header-input" name="q" autocomplete="off">
                </form>
            </div>
        </div>
    </div>
</section>
<!-- daftar alumni -->
<section id="daftar-alumni">
    <div class="container">
        <div class="daftar-title">
            Daftar Nama Alumni
        </div>
        <div class="row g-3 daftar-content">
            @foreach ($data_alumni as $alumni)
            <div class="col-6 col-lg-3">
                <div class="card-alumni">
                    <div class="row">
                        @if ($alumni->foto === null)
                        <img src="{{ asset('/assets/img/student.png') }}" alt="foto" class="img-alumni">
                        @else
                        <img src="{{ asset('/assets/img/alumni/'. $alumni->foto) }}" alt="foto" class="img-alumni">
                        @endif
                    </div>
                    <div class="row mt-4">
                        <div class="col alumni-name">
                            {{ $alumni->nama }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex flex-wrap">
                            @if ($alumni->is_active === '0')
                            <div class="d-flex me-2 mt-2 status-box">
                                <div class="circle">
                                </div>
                                Not Active
                            </div>
                            @elseif ($alumni->is_active === '1')
                            <div class="d-flex me-2 mt-2 status-box-active">
                                <div class="circle">
                                </div>
                                Active
                            </div>
                            @endif
                            <div class="d-flex me-2 mt-2 status-box">
                                <div class="circle">
                                </div>
                                {{$alumni->jurusan->akronim}}
                            </div>
                            <div class="d-flex me-2 mt-2 status-box">
                                <div class="circle">
                                </div>
                                {{$alumni->angkatan->angkatan}}
                            </div>
                            @if ($alumni->kerja_active !== null)
                            <div class="d-flex me-2 mt-2 status-box">
                                <div class="circle"></div>
                                Work
                            </div>
                            @endif
                            @if ($alumni->kuliah_active !== null)
                            <div class="d-flex me-2 mt-2 status-box">
                                <div class="circle"></div>
                                College
                            </div>
                            @endif
                            @if ($alumni->usaha_active !== null)
                            <div class="d-flex me-2 mt-2 status-box">
                                <div class="circle"></div>
                                Business
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col mx-1">
                            @if ($alumni->bio === null)
                            <p align="justify">-</p>
                            @else
                            <p align="justify">{{Str::limit($alumni->bio, 30)}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col d-flex justify-content-center align-items-center">
                            <a href="{{route('bkk.alumni.detail', encrypt($alumni->id_alumni))}}" class="alumni-btn">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- rekomendasi --}}
@if (auth()->user()->level_id === 'LVL00002')
<section id="content">
    <div class="container">
        <div class="sub-title">Rekomendasi Untuk Fulan!</div>
        <div class="small sub-desc">
            Berdasarkan Kejuruan
            <span class="text-primary">Teknologi/IT</span>
        </div>
        <!-- card -->
        <div class="row g-3">
            <div class="col-6 col-lg-4">
                <div class="lmr-box">
                    <div class="lmr-img">
                        <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                    </div>
                    <div class="fw-bold mt-4 fs-4 text-primary">
                        Staff Administrator
                    </div>
                    <div class="">PT. Pintro Indonesia</div>
                    <div class="my-3 fw-bold fs-5">Bekasi</div>
                    <ul>
                        <li>Berpenampilan Menarik</li>
                        <li>Mampu menggunakan komputer</li>
                        <li>Bersedia bekerja dibawah Tekanan</li>
                    </ul>
                    <a
                        href="#"
                        class="btn btn-primary w-100 mt-1 fw-bold lmr-btn"
                        >Details</a
                    >
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="lmr-box">
                    <div class="lmr-img">
                        <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                    </div>
                    <div class="fw-bold mt-4 fs-4 text-primary">
                        Staff Administrator
                    </div>
                    <div class="">PT. Pintro Indonesia</div>
                    <div class="my-3 fw-bold fs-5">Bekasi</div>
                    <ul>
                        <li>Berpenampilan Menarik</li>
                        <li>Mampu menggunakan komputer</li>
                        <li>Bersedia bekerja dibawah Tekanan</li>
                    </ul>
                    <a
                        href="#"
                        class="btn btn-primary w-100 mt-1 fw-bold lmr-btn"
                        >Details</a
                    >
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="lmr-box">
                    <div class="lmr-img">
                        <img src="{{ asset ('/assets/img/logo.png') }}" alt="" />
                    </div>
                    <div class="fw-bold mt-4 fs-4 text-primary">
                        Staff Administrator
                    </div>
                    <div class="">PT. Pintro Indonesia</div>
                    <div class="my-3 fw-bold fs-5">Bekasi</div>
                    <ul>
                        <li>Berpenampilan Menarik</li>
                        <li>Mampu menggunakan komputer</li>
                        <li>Bersedia bekerja dibawah Tekanan</li>
                    </ul>
                    <a
                        href="#"
                        class="btn btn-primary w-100 mt-1 fw-bold lmr-btn"
                        >Details</a
                    >
                </div>
            </div>
        </div>
    </div>
</section>

@endif
@include('partials.footer')
@endsection

@section('script')
@endsection
