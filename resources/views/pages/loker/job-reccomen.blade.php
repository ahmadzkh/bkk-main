@extends('templates.main')
@section('title', 'BKK 1 | Rekomendasi')
@section('css')
<!-- css -->
<link rel="stylesheet" href="../css/job-reccomen.css" />
@endsection

@section('container')
<!-- header -->
<section id="header" class="bg-biru pb-5">
        @include('partials.navbar')
        <div class="container header-wrap d-flex flex-column align-items-center justify-content-end" style="height: 200px">
            <div class="row">
                <div class="col text-center text-lg-start">
                    <span class="header-sub"> Job </span>
                    <br />
                    <span class="header-text"> Recommendation </span>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
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
                            <img src="../assets/logo.png" alt="" />
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
                            <img src="../assets/logo.png" alt="" />
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
                            <img src="../assets/logo.png" alt="" />
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

    <div class="row g-3">
        <div class="col-6 col-lg-4">
            <div class="lmr-box">
                <div class="lmr-img">
                    <img src="../assets/logo.png" alt="" />
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
                    <img src="../assets/logo.png" alt="" />
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
                    <img src="../assets/logo.png" alt="" />
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

    <!-- footer -->
@include('partials.footer')
@endsection

@section('script')
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"
></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
@endsection
