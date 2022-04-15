@extends('templates.main')

@section('title', 'BKK 1 | Dashboard Mitra')

@section('css')
    <!-- SELECT 2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    {{-- INTERN CSS --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/styleMitra.css') }}">

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
        /* STYLING TABLE */
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
            .content-wrapper {
                margin-left: 0px;
                margin-right: 0px;
            }
            .navbar-toggle {
                padding: 5px 5px 5px 2px;
            }
            .navbar-toggle i.bx-chevrons-right {
                font-size: 16px;
            }
            .waves {
                width: 100vw;
                height: 300px;
            }
        }
    </style>
@endsection

@section('section')
    @include('partials.navbar-mitra')

    <div class="main-page">
        @include('partials.sidebar-mitra')

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
                <h1 class="fw-light">Tahap</h1>
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

            <div class="alumni-table bg-white p-3 rounded-15">
                <div class="header d-flex justify-content-between mb-3">
                    <div class="">
                        <h3 class="fw-bold mb-0">Tahap</h3>
                        <p>Berikut ini adalah data tahapan-tahapan.</p>
                    </div>
                    <div>
                        <button class="btn btn-primary rounded-15 px-4" data-bs-toggle="modal" data-bs-target="#addTahap">
                            <p class="d-inline align-middle fw-bold">Tambah</p>
                        </button>
                    </div>
                </div>
                <div class="data-table rounded-20 py-2">
                    <!-- ISI DATATABLE -->
                    <div class="content mb-2 overflow-auto">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Loker</th>
                                    <th scope="col">Tahap Ke</th>
                                    <th scope="col">Nama Pelamar</th>
                                    <th scope="col">Tanggal Dimulai</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($tahap == 0)
                                <tr>
                                    <td>BELUM ADA DATA</td>
                                </tr>
                                @else
                                @foreach ($tahap as $key => $data)
                                <tr class="align-middle">
                                    <th scope="row">{{ $key += 1 }}</th>
                                    <td>{{ $loker->id }}</td>
                                    <td>{{ $data->tahap_ke }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_seleksi)->format('d M Y') }}</td>
                                    @if ($data->status == '1')
                                    <td>Belum Dimulai</td>
                                    @else
                                    <td>Selesai</td>
                                    @endif
                                    <td>
                                        <a href="/mt/lk/tahap/detail/{{ $data->id }}"
                                        class="btn btn-primary rounded-15 fw-bold">
                                        {{ $data->status == '1' ? 'Seleksi' : 'Detail' }}</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Tahap -->
    <div class="modal fade" id="addTahap" aria-labelledby="addTahapLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-15">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTahapLabel">Tambah Tahap</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/mt/lk/tahap/post" method="POST">
                        @csrf
                        <input type="hidden" name="loker_id" value="{{ $loker->id }}">
                        <div class="mb-3">
                            <label for="tahap_ke" class="form-label">Tahap Ke</label>
                            <input type="number" class="form-control rounded-15" id="tahap_ke" placeholder="Tahap Ke..."
                                name="tahap_ke" value="{{ old('tahap_ke') }}" min="1" max="15">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control rounded-15" id="nama" placeholder="Nama Tahap..."
                                name="nama" value="{{ old('nama') }}">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_seleksi" class="form-label">Tanggal Seleksi</label>
                            <input type="date" class="form-control rounded-15" id="tanggal_seleksi"
                                placeholder="Tanggal Seleksi..." name="tanggal_seleksi"
                                value="{{ old('tanggal_seleksi') }}">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control rounded-15" id="keterangan" rows="3"
                                name="keterangan">{{ old('keterangan') }}</textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="defaultMsg" name="defaultMsg">
                            <label class="form-check-label" for="defaultMsg">Gunakan keterangan otomatis.</label>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary rounded-15 fw-bold"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary rounded-15 fw-bold">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#select2").select2({
                dropdownParent: $("#addTahap")
            });
        });
        $('#defaultMsg').click(function() {
            if ($(this).is(':checked') == true) {
                $('#keterangan').attr("readonly", true);
            } else {
                $('#keterangan').removeAttr('readonly');
            }
        });
    </script>
@endsection
