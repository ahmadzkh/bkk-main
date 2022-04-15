@extends('templates.main')
@section('title', 'BKK 1 | Job Vacancy')
@section('css')
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
<script src="{{asset ('/assets/js/jquery.js')}}"></script>
<link rel="stylesheet" href="{{asset ('/assets/js/select2/dist/css/select2.min.css')}}">
<script src="{{asset ('/assets/js/select2/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset ('/assets/css/lowongan.css')}}">
@endsection
@section('container')
<!-- header -->
<section id="header" class="bg-biru pb-5">
    @include('partials.navbar')
    <div class="container header-wrap d-flex flex-column align-items-center justify-content-end" style="height: 300px">
        <div class="row">
            <div class="header-title text-center text-lg-start">
                Looking for JOB?
            </div>
            <form action="" class="" method="GET">
                @csrf
                <div class="row p-0 d-flex justify-content-center">
                    <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                        <input type="text" class="input-box" placeholder="Search Category" name="title">
                    </div>
                    <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                        {{-- <input type="text" class="input-box" placeholder="Kategori Pekerjaan"> --}}
                        <select class="lokasi input-box" name="wilayah">
                            <option value="" hidden></option>
                            <option value="Bekasi">Bekasi</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Yogyakarta">Jogja</option>
                            <option value="Bogor">Bogor</option>
                            <option value="Tangerang">Tangerang</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-4">
                        <select class="kategori input-box" name="label">
                            <option value="" hidden></option>
                            <option value="IT">IT</option>
                            <option value="Akuntan">Akuntan</option>
                            <option value="Multimedia">Multimedia</option>
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="submit-btn">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- popular -->
<section id="popular">
    <div class="container">
        <div class="row sub-title">
            <div class="col mt-5 fs-2 fw-bolder">Popular</div>
            <a href="#" class="col mt-5 text-end align-self-center text-black">
                See All
            </a>
        </div>
        <div class="row g-3" data-masonry='{"percentPosition": true }'>
            @foreach ($loker as $lok)
            <div class="col-12 col-lg-4">
                <a href="{{ route('bkk.loker.detail', $lok->slug) }}" class="text-decoration-none a-low">
                    <div class="lowongan-box">
                        @if ($lok->mitra->foto === 'default-company.png')
                        <img src="{{asset('/assets/img/imp/' . $lok->mitra->foto)}}" alt="mitra" class="img-fluid lowongan-logo">
                        @else
                        <img src="{{asset('/assets/img/mitra/' . $lok->mitra->foto)}}" alt="mitra" class="img-fluid lowongan-logo">
                        @endif
                        <div class="judul-lowongan fw-bold text-biru mt-2 fs-4">
                            {{ $lok->title }}
                        </div>
                        <div class="small text-black">
                            {{ $lok->mitra->jenis }}. {{ $lok->mitra->nama }}
                        </div>
                        <div class="fw-bold my-3 text-black">
                            <i class="bi-geo-fill me-1"></i> {{ $lok->kantor->wilayah }}
                        </div>
                        <div class="lowongan-overview text-secondary">
                            <ul>
                                @php
                                $no = 1 ;
                                @endphp
                                @foreach ($lok->persyaratan as $req)
                                @if ($no <= 3) <li>{{ $req->text }}</li>
                                    @endif
                                    @php $no++; @endphp
                                    @endforeach
                            </ul>
                        </div>
                        <div class="lowongan-footer">
                            <hr>
                            <div class="date small text-black-50">{{
                                \Carbon\Carbon::parse($lok->created_at)->diffForHumans()}}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- partner -->
<section id="partner">
    <div class="container">
        <div class="row sub-title">
            <div class="my-5 fs-1 fw-bolder">Partners</div>
        </div>
        <img src="{{asset ('/assets/img/partners.png')}}" alt="" class="img-fluid" draggable="false">
    </div>
</section>

<!-- footer -->
@include('partials.footer')
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.lokasi').select2({
            placeholder: "Lokasi",
        });
        $('.kategori').select2({
            placeholder: "Kategori"
        })
    });
</script>
@endsection
