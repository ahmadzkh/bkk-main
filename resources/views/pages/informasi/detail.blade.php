@extends('templates.main')
@section('title', 'BKK 1 | Detail Lowongan')

@section('css')
<!-- css -->
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
<link rel="stylesheet" href="{{ asset('/assets/css/information-detail.css') }}">
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
                        Information
                    </span>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <section id="content">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <div class="detail-box">
                        <div class="detail-cover">
                            @if ($new->banner === null)
                            <img src="{{ asset('/assets/img/info.jpg') }}" alt="banner">
                            @else
                            <img src="{{ asset('/assets/img/news/'.$new->banner) }}" alt="banner">
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="info-title fs-3 fw-bold">{{ $new->title }}</div>
                            <div class="small text-black-50">
                                Administrator BKK <span class="mx-2">|</span> <i class="bi-calendar"></i> {{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}
                            </div>
                            <div class="my-4 info-text">
                                {{ $new->content }}
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            @if ($new->image_satu === null)

                            @else
                            <div class="col-3">
                                <img src="{{ asset('/assets/img/news/'.$new->image_satu) }}" alt="image_satu" style="width:250px; height:150px; ">
                            </div>
                            @endif
                            @if ($new->image_dua === null)

                            @else
                            <div class="col-3">
                                <img src="{{ asset('/assets/img/news/'.$new->image_dua) }}" alt="image_dua" style="width:250px; height:150px; ">
                            </div>
                            @endif
                            @if ($new->image_dua === null)

                            @else
                            <div class="col-3">
                                <img src="{{ asset('/assets/img/news/'.$new->image_dua) }}" alt="image_dua" style="width:250px; height:150px; ">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="berita-title black">Artikel Lainnya</div>
            </div>
            <div class="row g-3 mt-3">
                @foreach ($news as $item)
                <div class="col-lg-4">
                    <a href="{{ route('bkk.informtiona.detail', $item->slug) }}" class="text-decoration-none a-info">
                        <div class="box-info">
                            <div class="info-cover">
                                <img src="{{ asset('/assets/img/pisang.jpg') }}" alt="banner" class="img-fluid" />
                            </div>
                        <div class="p-3 judul-info fw-bold text-black">
                            {{ $item->title }}
                        </div>
                        <div class="row p-3 text-black-50">
                            <div class="col">
                                <div class="small">Administrator BKK</div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <div class="small">
                                    <i class="bi bi-calendar me-1"></i> {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="../jquery.js"></script>
    <script src="../owlcarousel/dist/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
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
