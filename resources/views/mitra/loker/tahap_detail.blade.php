@extends('templates.main')

@section('title', 'BKK 1 | Dashboard Mitra')

@section('css')
    <!-- SELECT 2 -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="/assets/js/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    {{-- INTERNAL CSS --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/custom-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/styleMitra.css') }}">

    <style>
        .title-page h1.fw-bold {
            margin-bottom: 120px;
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
    </style>
@endsection

@section('container')
    @include('partials.navbar-mitra')

    <div class="main-page">
        @include('partials.sidebar-mitra')

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="position-absolute waves overflow-hidden"
            preserveAspectRatio="none">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,288L60,282.7C120,277,240,267,360,234.7C480,203,600,149,720,149.3C840,149,960,203,1080,213.3C1200,224,1320,192,1380,176L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg>

        <div class="container-lg py-3 content-wrapper">
            <!-- TITLE -->
            <div class="title-back">
                <a href="{{ url()->previous() }}" class="d-flex align-items-center text-decoration-none text-white"><i
                        class='bx bx-left-arrow-alt'></i>Back</a>
            </div>
            <div class="title-page text-white my-5">
                <h1 class="fw-light">Seleksi Tahap</h1>
                <h1 class="fw-bold">Detail</h1>
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

            <div class="alumni-table bg-white p-2 rounded-15">
                <div class="header d-flex justify-content-between align-items-center mb-3">
                    <div class="">
                        <h3 class="fw-bold mb-0">Tes Fisik</h3>
                        <p>Berikut ini adalah data alumni yang lolos seleksi Tes Fisik.</p>
                    </div>
                    <div>
                        <button class="btn btn-primary rounded-15 px-4" id="invoke" class="warn">
                            <p class="d-inline align-middle fw-bold">Tambah</p>
                        </button>
                        <button class="btn btn-primary rounded-15 px-4">
                            <p class="d-inline align-middle fw-bold">Print</p>
                        </button>
                    </div>
                </div>
                <div class="data-table rounded-20 py-2 px-lg-4">
                    <!-- ISI DATATABLE -->
                    <div class="content mb-2 overflow-auto">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <td colspan="6">Pelamar yang lolos tahap {{ $tahap->nama }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Pelamar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">No. Telp</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelamar as $key => $data)
                                    @if ($data->keterangan == 1)
                                        <tr>
                                            <th scope="row">{{ $key += 1 }}</th>
                                            <td>{{ $data->pelamar_id }}</td>
                                            <td>{{ $data->alumni->nama }}</td>
                                            <td>{{ $data->alumni->user->email }}</td>
                                            <td>{{ $data->alumni->no_telp }}</td>
                                            <td>{{ $data->nilai }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="6">Pelamar yang tidak lolos tahap {{ $tahap->nama }}</td>
                                </tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pelamar as $key => $data)
                                    @if ($data->keterangan == 0)
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $data->pelamar_id }}</td>
                                            <td>{{ $data->alumni->nama }}</td>
                                            <td>{{ $data->alumni->user->email }}</td>
                                            <td>{{ $data->alumni->no_telp }}</td>
                                            <td>{{ $data->nilai }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog class="modalCSM" id="modalCSM">
        <form action="/mt/lk/tahap/asd" method="POST">
            <div class="header d-flex justify-content-between mb-3">
                <strong>Tambah Pelamar</strong>
                <button type="button" class="btn-close" id="cancelCSM"></button>
            </div>
            <div class="modal-main mb-3">
                <div class="alert alert-warning rounded-15">
                    <p class="mb-0"><i class='bx bx-info-circle align-middle' style="font-size: 28px;"></i>
                        Data yang sudah dikirim tidak bisa diubah atau dihapus.</p>
                </div>
                @csrf
                <div class="mb-3">
                    <label for="pelamar" class="form-label">Pilih Pelamar</label>
                    <select class="js-select2 form-control" id="select2" name="pelamar">
                        <option selected hidden disabled>Pilih Pelamar</option>
                        @foreach ($alumni as $pel)
                            <option @if (old('pelamar') == $pel->id) selected @endif value="{{ $pel->id }}">
                                {{ $pel->nama }} - {{ $pel->jurusan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" class="form-control rounded-15" id="nilai" name="nilai" min="0" max="10000"
                        value="{{ old('nilai') }}">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <select class="form-select" name="keterangan" id="keterangan">
                        <option hidden disabled selected>Pilih Keterangan</option>
                        <option @if (old('keterangan') == '1') ? selected : '' ; @endif value="1">Tidak Lolos</option>
                        <option @if (old('keterangan') == '2') ? selected : '' ; @endif value="2">Lolos</option>
                    </select>
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
    <script src="/assets/js/custom-modal.js"></script>

    <script>
        $(document).ready(function() {
            $("#select2").select2({
                dropdownParent: $("#modalCSM")
            });
        });
        // $('#defaultMsg').click(function() {
        //     // console.log($(this).is(':checked'));
        //     if ($(this).is(':checked') == true) {
        //         $('#judul').attr("readonly", true);
        //         $('#text').attr("readonly", true);
        //     } else {
        //         $('#judul').removeAttr('readonly');
        //         $('#text').removeAttr('readonly');
        //     }
        // });
    </script>
@endsection
