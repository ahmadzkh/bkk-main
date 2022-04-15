@extends('templates.main')
@section('title', 'BKK 1 | Mitra')
@section('css')
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/css/mitra.css') }}">
@endsection
@section('container')
<!-- header -->
<section id="header" class="bg-biru pb-5">
    @include('partials.navbar')
    <div class="container header-wrap d-flex flex-column align-items-center justify-content-end" style="height: 200px">
        <div class="row">
            <div class="col header-text">
                Partners
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
<!-- content -->
<section id="content">
    <div class="container">
        <div class="sub-title">List Mitra</div>
        <div class="row justify-content-center g-2 g-lg-4" data-masonry='{"percentPosition": true }'>
            @foreach ($data_mitra as $data)
            <div class="col-6 col-lg-3">
                <div class="box">
                    <img src="{{ asset('/assets/img/g.png') }}" alt="" class="rounded img-fluid mitra-img">
                    <div class="nama-mitra text-center">{{ $data->nama }}</div>
                    <a href="{{ route('bkk.mitra.detail', $data->id_mitra) }}"
                        class="btn btn-primary mitra-btn">Details</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center my-5">
            <a href="" class="btn btn-secondary see-btn">See More</a>
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                Mitra yang telah berkerja sama sudah menyepakati persyaratan bersama. Dan untuk membangun para
                alumni dalam berkerja.
            </div>
        </div>
    </div>
</section>
@include('partials.footer')
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
</script>
@endsection
