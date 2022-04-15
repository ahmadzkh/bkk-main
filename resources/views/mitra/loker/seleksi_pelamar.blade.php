@extends('templates.main')

@section('title', 'BKK 1 | Dashboard Mitra')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- INTERNAL CSS --}}
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
        .data-table {
            margin-left: 10px;
            margin-right: 10px;
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
        /* STYLING IMG PROFIL */
        /* STYLING LOADING IMG */
        #loading-wrapper {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            overflow: hidden;
            background: rgba(000, 000, 000, 0.4);
        }
        #loading-wrapper .loading-img {
            position: absolute;
            top: 45vh;
            left: 48vw;
        }
    </style>
@endsection

@section('container')

    @include('partials.navbar-mitra')
    <div class="main-page d-flex">
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
                <a href="{{ url()->previous() }}" class="d-flex align-items-center text-decoration-none text-white"><i
                        class='bx bx-left-arrow-alt'></i>Back</a>
            </div>
            <div class="title-page text-white my-5">
                <h1 class="fw-light">Seleksi Pelamar</h1>
                <h1 class="fw-bold">{{ $loker_id }}</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-15">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="alumni-table bg-white p-2 rounded-15">
                <div class="data-table rounded-20 py-2">
                    <!-- HEADING DATATABLE -->
                    <div class="header d-flex justify-content-between mb-3">
                        <div class="">
                            <h3 class="fw-bold mb-0">Tes Fisik - Tahap 1</h3>
                            <p>Pilih alumni berikut untuk lanjut ke tahap berikutnya.</p>
                        </div>
                    </div>
                    <!-- ISI DATATABLE -->
                    <div class="content mb-2 overflow-auto">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Pelamar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Angakatan</th>
                                    <th scope="col">Tanggal Submit</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col" class="d-flex justify-content-center">Lulus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pelamar->isEmpty())
                                    <td colspan="8" class="text-center p-5">BELUM ADA DATA</td>
                                @else

                                <form action="/mt/lk/tahap/seleksi/{{ $tahap->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="tahap_id" value="{{ $tahap->id }}">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pelamar as $key => $data)
                                        <input type="hidden" name="alumni_id[]" value="{{ $data->alumni->id }}">
                                        <input type="hidden" name="pelamar_id[]" value="{{ $data->pelamar->id }}">
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $data->pelamar->id }}</td>
                                            <td><a href="javascript:void(0)" id="detail-alumni"
                                                data-id="{{ $data->alumni->id }}"
                                                    class="text-link-black text-decoration-none">{{ $data->alumni->nama }}</a>
                                            </td>
                                            <td>{{ $data->alumni->jurusan->nama }}</td>
                                            <td>{{ $data->alumni->angkatan->tahun_masuk }}/{{ $data->alumni->angkatan->tahun_lulus }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_submit)->format('d M Y') }}</td>
                                            <td><input type="number" name="nilai[]" id="nilai" class="form-control"
                                                    style="min-width: 70px;" min="1" max="1000"></td>
                                            <td class="d-flex justify-content-center"><input type="hidden"
                                                    name="loloscek[{{ $key }}]" value="0"><input type="checkbox"
                                                    class="form-check-input" name="loloscek[{{ $key }}]"
                                                    id="lolosCheck" onclick="updateCount()"></td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary fw-bold rounded-15 px-5" id="lolosButton">Pilih
                                pelamar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LOADING --}}
    <div id="loading-wrapper" class="">
        <img src="/assets/img/imp/loading.gif" class="loading-img" id="loading-img" width="100px">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailAlumni" tabindex="-1" aria-labelledby="detailAlumniLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-15">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="detailAlumniLabel">Alumni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="img-profil mb-2 col-12 d-flex justify-content-center">
                            <img src="" id="img-profil" width="120px" class="rounded-15" draggable="false">
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="mb-0 fw-bold">Nama</p>
                            <p class="" id="nama_al">Nama</p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="mb-0 fw-bold">Jurusan</p>
                            <p class="" id="jurusan_al">Jurusan</p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="mb-0 fw-bold">Angkatan</p>
                            <p class="" id="angkatan_al">Angkatan</p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="mb-0 fw-bold">Umur</p>
                            <p class="" id="umur_al">17 Tahun</p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="mb-0 fw-bold">Berat Badan</p>
                            <p class="" id="bb_al">56 Kg</p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="mb-0 fw-bold">Tinggi Badan</p>
                            <p class="" id="tb_al">174 Cm</p>
                        </div>
                        <div class="col-12">
                            <a href="#" class="btn btn-primary fw-bold rounded-15 w-100">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/assets/js/jquery.min.js"></script>
    <script>
        function updateCount() {
            var cekLength = $("#lolosCheck:checked").length;
            if (cekLength > 0) {
                $("#lolosButton").html('Lolos (' + cekLength + ' pelamar)');
            } else {
                $("#lolosButton").html('Pilih pelamar');
            }
        };
        $(window).on('load', function() {
            $('#loading-wrapper').addClass('invisible');
        })
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /* When click show user */
            $('body').on('click', '#detail-alumni', function() {
                $('#loading-wrapper').removeClass('invisible');
                var alumni_id = $(this).data('id');
                $.get('/alumni-detail/' + alumni_id, function(data) {
                    $('#detailAlumniLabel').html("Alumni Details");
                    $('#detailAlumni').modal('show');
                    $('#nama_al').html(data.nama);
                    $('#jurusan_al').html(data.jurusan_id);
                    $('#angkatan_al').html(data.angkatan_id);
                    $('#bb_al').html(data.berat_badan + ' Kg');
                    $('#tb_al').html(data.tinggi_badan + ' Cm');
                    $('#umur_al').html(data.tanggal_lahir);
                    $('#img-profil').attr('src', '/assets/img/' + data.foto);
                    // console.log(data);
                }).
                done(function() {
                    $('#loading-wrapper').addClass('invisible');
                })
            });
        });
    </script>
@endsection
