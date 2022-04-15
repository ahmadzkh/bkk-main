@extends('templates.main')
@section('title', 'BKK 1 | News')
@section('css')
<!-- css -->
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/css/information.css') }}">
@endsection

@section('container')
    <!-- header -->
    <section id="header" class="bg-biru pb-5">
        @include('partials.navbar')
        <div class="container header-wrap d-flex flex-column align-items-center justify-content-end" style="height: 300px">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="header-text">
                        Informations
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col search-bg">
                    <form action="" class="d-flex justify-content-center">
                        <button type="submit" class="header-btn">
                            <i class="bi bi-search text-white px-3"></i>
                        </button>
                        <input type="text" placeholder="Search.." class="header-input">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- comtemt -->
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="sub-title">Latest Information</div>
                <div class="row g-3">
                    @foreach ($news as $new)
                    <div class="col-lg-4">
                        <a href="{{ route('bkk.informtiona.detail', $new->slug) }}" class="text-decoration-none">
                            <div class="box-info">
                                <div class="info-cover">
                                    @if ($new->banner == null)
                                    <img src="{{ asset('/assets/img/pisang.jpg') }}" alt="banner" class="img-fluid">
                                    @else
                                    <img src="{{ asset('/assets/img/news/'. $new->banner) }}" alt="banner" class="img-fluid">
                                    @endif
                                </div>
                                <div class="p-3 judul-info fw-bold text-black">
                                    {{ $new->title }}
                                </div>
                                <div class="row p-3 text-black-50">
                                    <div class="col">
                                        <div class="small">Administrator BKK</div>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <div class="small"><i class="bi bi-calendar me-1"></i> {{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @include('partials.footer')
@endsection
