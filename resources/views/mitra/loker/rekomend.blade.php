@extends('layouts.master')

@section('titlepage', 'Rekomend ' . $loker->id . ' | Mitra')

@section('css')
    <!-- SELECT 2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- INTERN CSS -->
    <link rel="stylesheet" href="../../../assets/css/custom-modal.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/styleMitra.css">

    <style>
        .title-page h1.fw-bold {
            margin-bottom: 60px;
        }
        .dropdown-menu {
            min-width: 0px;
        }
        .page-item:first-child .page-link {
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }
        .page-item:last-child .page-link {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        /* STYLING SEARCH */
        .search input {
            height: 60px;
            /* padding-left: 55px; */
            font-size: 18px;
            border: 2px solid rgb(193, 193, 193);
            border-radius: 0px 20px 20px 0px;
            border-left: 0px;
        }
        .search i.bx {
            z-index: 10;
            font-size: 30px;
            top: 15px;
            left: 2%;
            color: rgba(0, 0, 0, 0.5);
        }
        form .btn-search {
            border: 2px solid rgb(193, 193, 193);
            border-right: 0px;
            border-radius: 20px 0px 0px 20px;
            background: #fff;
        }
        /* STYLING TABLE */
        .data-table {
            margin-left: 20px;
            margin-right: 30px;
        }
        .data-table .header button:nth-child(2) i.bxs-plus-circle {
            font-size: 18px;
        }
        .data-table .tools {
            background-color: #2041BB;
            color: #fff;
            font-size: 18px;
        }
        .data-table .content .table {
            overflow-x: scroll;
        }
        .data-table .content ul i.bx {
            font-size: 18px;
        }
        .data-table .content .table tbody tr td.icon {
            display: none;
        }
        .data-table .content .table tbody tr:hover td.icon {
            display: block;
        }
        /* STYLING SELECT */
        .select2.select2-container {
            width: 100% !important;
        }
        .select2.select2-container .select2-selection {
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 40px;
            outline: none !important;
            transition: all .15s ease-in-out;
        }
        .select2.select2-container .select2-selection .select2-selection__rendered {
            color: #333;
            line-height: 38px;
            padding-right: 33px;
            padding-left: 12px;
            font-size: 1rem;
        }
        .select2.select2-container .select2-selection .select2-selection__arrow {
            background: #f8f8f8;
            border-left: 1px solid #ccc;
            -webkit-border-radius: 0 10px 10px 0;
            -moz-border-radius: 0 10px 10px 0;
            border-radius: 0 10px 10px 0;
            height: 38px;
            width: 40px;
        }
        @media only screen and (max-width: 768px) {
            /* UBAH PREVIEW DAN DATA */
            .search i.bx {
                left: 5% !important;
            }
        }
    </style>
@endsection

@section('section')

    @include('layouts.navbar')

    <div class="main-page">
        @include('layouts.sidebar-mitra')

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="position-absolute waves"
            preserveAspectRatio="none">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,288L60,282.7C120,277,240,267,360,234.7C480,203,600,149,720,149.3C840,149,960,203,1080,213.3C1200,224,1320,192,1380,176L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg>

        <div class="container-lg py-3 content-wrapper">
            <!-- TITLE -->
            <div class="title-back">
                <a href="/mt/lk/detail/{{ $loker->id }}"
                    class="d-flex align-items-center text-decoration-none text-white"><i
                        class='bx bx-left-arrow-alt'></i>Back</a>
            </div>
            <div class="title-page text-white my-5">
                <h1 class="fw-light">Rekomendasi</h1>
                <h1 class="fw-bold">{{ $loker->id }}</h1>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissable rounded-15">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger rounded-15">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="alumni-table">
                <!-- SEARCH BAR -->
                <div class="search py-3">
                    <form action="" class="position-relative d-flex justify-content-center">
                        <div class="input-group mb-3">
                            <button class="input-group-text btn-search"><i class='bx bx-search'></i></button>
                            <input type="text" class="form-control" placeholder="Search Pelamar..." aria-label="search"
                                name="search">
                        </div>
                    </form>
                </div>
                <div class="data-table rounded-20 py-2">
                    <!-- HEADING DATATABLE -->
                    <div class="header d-flex justify-content-between mb-3">
                        <button class="btn btn-primary rounded-15 dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">10</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">10</a></li>
                            <li><a class="dropdown-item" href="#">20</a></li>
                            <li><a class="dropdown-item" href="#">30</a></li>
                        </ul>
                        <div>
                            <button class="btn btn-primary rounded-15 px-4" id="invoke" class="warn">
                                <p class="d-inline align-middle fw-bold">Add</p>
                            </button>
                            <button class="btn btn-primary rounded-15 px-4">
                                <p class="d-inline align-middle fw-bold">Print</p>
                            </button>
                        </div>
                    </div>
                    <!-- ISI DATATABLE -->
                    <div class="content mb-2 overflow-auto">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Rekomend</th>
                                    <th scope="col">Alumni</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Angkatan</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($rekomend as $key => $rek)
                                    {{-- MERELASIKAN DATA REKOMENDASI --}}
                                    {{-- @if ($rek->id_lowongankerja == $loker->id) --}}
                                    <tr>
                                        <th scope="row">{{ $index++ }}</th>
                                        <td>{{ $rek->id }}</td>
                                        <td>{{ $rek->alumni_direkomend->alumni->nama }}</td>
                                        <td>{{ $rek->alumni_direkomend->alumni->jurusan->nama }}</td>
                                        <td>{{ $rek->alumni_direkomend->alumni->angkatan->tahun_masuk }}/{{ $rek->alumni_direkomend->alumni->angkatan->tahun_lulus }}
                                        </td>
                                        <td>{{ ucwords($rek->status) }}</td>
                                    </tr>
                                    {{-- @endif --}}
                                @endforeach
                            </tbody>
                        </table>
                        <!-- PAGINASI -->
                    </div>
                    <nav class="d-flex justify-content-end">
                        <ul class="pagination rounded-20">
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class='bx bx-chevron-left align-middle'></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i
                                        class='bx bx-chevron-right align-middle'></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <dialog class="modalCSM" id="modalCSM">
        <form action="/mt/lk/rekomend/post" method="POST">
            <div class="header d-flex justify-content-between mb-3">
                <strong>Tambah Rekomendasi</strong>
                <button type="button" class="btn-close" id="cancelCSM"></button>
            </div>
            <div class="modal-main mb-3">
                <div class="alert alert-warning rounded-15">
                    <p class="mb-0"><i class='bx bx-info-circle align-middle' style="font-size: 28px;"></i>
                        Data yang sudah dikirim tidak bisa diubah atau dihapus.</p>
                </div>
                @csrf
                <div class="mb-3">
                    <label for="alumni" class="form-label">Pilih Alumni</label>
                    <select class="js-select2 form-control" id="select2" name="alumni">
                        <option selected hidden>Pilih Alumni</option>
                        @foreach ($alumni as $alm)
                            <option @if (old('alumni') == $alm->id) selected @endif value="{{ $alm->id }}">
                                {{ $alm->nama }} -
                                {{ $alm->jurusan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="loker" class="form-label">Lowongan Kerja</label>
                    <input type="text" class="form-control rounded-15" id="loker" name="loker" value="{{ $loker->id }}"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Deskripsi</label>
                    <input type="text" class="form-control rounded-15" id="judul"
                        placeholder="Anda direkomendasi untuk pekerjaan ini..." name="judul" value="{{ old('judul') }}">
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Deskripsi</label>
                    <textarea class="form-control rounded-15" id="text" rows="3" name="text">{{ old('text') }}</textarea>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="defaultMsg" name="defaultMsg">
                    <label class="form-check-label" for="defaultMsg">Gunakan pesan otomatis.</label>
                </div>
            </div>
            <menu class="modal-menu">
                <small><i class='bx bxs-keyboard align-middle'></i> esc</small>
                <button class="modal-button fw-bold" id="buttoncancelCSM" type="button">Close</button>
                <button class="modal-button bg-primary fw-bold" type="submit">Submit</button>
            </menu>
        </form>
    </dialog>
@endsection

@section('script')
    <script src="../../../assets/js/custom-modal.js"></script>

    <script>
        $(document).ready(function() {
            $("#select2").select2({
                dropdownParent: $("#modalCSM")
            });
        });
        $('#defaultMsg').click(function() {
            // console.log($(this).is(':checked'));
            if ($(this).is(':checked') == true) {
                $('#judul').attr("readonly", true);
                $('#text').attr("readonly", true);
            } else {
                $('#judul').removeAttr('readonly');
                $('#text').removeAttr('readonly');
            }
        });
    </script>
@endsection
