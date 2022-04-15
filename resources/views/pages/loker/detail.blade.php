@extends('templates.main')
@section('title', 'BKK 1 | Lowongan Kerja')
@section('css')
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
<link rel="stylesheet" href="{{asset ('/assets/css/lowongan-detail.css')}}">
@endsection

@section('container')
    <!-- header -->
    <section id="header" class="bg-biru pb-5">
        @include('partials.navbar')
        <div class="container header-wrap d-flex flex-column align-items-center justify-content-end" style="height: 300px">
            <div class="row">
                <div class="col text-center text-lg-start">
                    <span class="header-sub ">
                        <a class="align-middle text-decoration-none mb-1 text-white" href="{{ route('bkk.loker') }}" style="font-size: 18px;"><i class="bx bx-chevron-left"></i> Kembali</a>
                        <p mb-0>Detail</p>
                    </span>
                    <br>
                    <span class="header-text">
                        Lowongan
                    </span>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <section id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col box">
                    <div class="box-sampul">
                    </div>
                    <img src="{{ asset($urlImg.$loker->mitra->foto) }}" alt="" class="profil-img img-fluid" draggable="false">
                    <div class="box-wrap pb-5">
                        <!-- nama -->
                        <div class="box-title">
                            {{ $loker->title }}
                        </div>
                        <div class="nama-pt">
                            <a href="{{ route('bkk.mitra.detail', $loker->mitra->id_mitra) }}" class="text-decoration-none">
                                {{ $loker->mitra->jenis }}. {{ $loker->mitra->nama }}
                            </a>
                        </div>
                        <div class="alamat">
                            <i class="bi bi-geo-alt-fill me-2"></i>{{ $loker->mitra->wilayah }}
                        </div>
                        <div class="desc-pt">
                            {!! $loker->mitra->overview !!}
                        </div>
                        @auth
                        @if (auth()->user()->level_id === 'LVL00002')
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('alumni.aplly') }}" class="apply-btn">Apply Now</a>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- job desc -->
    <section id="job-desc">
        <div class="container">
            <div class="sub-title">Job Description</div>
            <div class="box-desc mt-5">
                {!! $loker->deskripsi !!}
            </div>
            <div class="box-desc mt-5">
                <div class="fw-bold fs-2 mb-3">Persyaratan:</div>
                <ul class="mb-0">
                    @foreach ($requirement as $req)
                        <li>{{ $req->text }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="box-desc mt-5">
                <div class="fw-bold fs-2 mb-3">Tahap:</div>
                @foreach ($tahap as $thp)
                    <div class="col-6">
                        <div class="pe-1">
                            @auth
                            @if (auth()->user()->level_id === 'LVL00003')
                            <a href="{{ route('mitra.tahap.detail', $thp->id_tahap) }}"
                                class="text-decoration-none text-link-black">
                                <p class="fw-bold mb-0">{{ $thp->nama }}</p>
                            </a>
                            @else
                            <p class="fw-bold mb-0">{{ $tahap->nama }}</p>
                            @endif
                            @endauth
                            <p>Dilaksanankan pada {{ \Carbon\Carbon::parse($thp->tanggal_seleksi)->format('d F Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- highlight -->
    <section id="highlight">
        <div class="container">
            <div class="sub-title">Informasi Tambahan</div>
            <div class="box-desc highlight-wrap">
                <div class="row">
                    <div class="col-6">
                        <h4 class="fw-bold mb-0">Jenis Pekerjaan</h5>
                                <h4 class="fw-normal">{{ $loker->jenis_pekerjaan }}</h5>
                    </div>
                    <div class="col-6">
                        <h4 class="fw-bold mb-0">Spesialisasi</h5>
                                <h4 class="fw-normal">{{ $loker->kategori }}</h5>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-6">
                        <h4 class="fw-bold mb-0">Kedaluwarsa</h5>
                        <h4 class="fw-normal">
                            {{ \Carbon\Carbon::parse($loker->kedaluwarsa)->format('d M Y') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    @include('partials.footer')
@endsection

@section('script')
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T
@endsection
