@extends('templates.main')
@section('title', 'BKK 1 | Dashboard Admin')
@section('css')
    <link rel="stylesheet" href="/assets/css/style.css">
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
            padding-left: 55px;
            font-size: 18px;
            border: 2px solid rgba(0, 0, 0, 0.2);
        }
        .search i.bx {
            z-index: 10;
            font-size: 30px;
            top: 15px;
            left: 5%;
            color: rgba(0, 0, 0, 0.5);
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

        .tols{
            font-size: 24px;
        }
    </style>
@endsection
@section('container')
    <div class="main-page">
        @include('partials.sidebar-admin')

        <img src="{{asset ('/assets/img/wave2.svg')}}" class="position-absolute waves">

        <div class="content-outer-wrapper mx-auto">
            <div class="py-3 content-wrapper">
                <!-- TITLE -->
                <div class="title-back">
                    <a href="{{URL::previous()}}" class="d-flex align-items-center text-decoration-none text-white"><i
                            class='bx bx-left-arrow-alt'></i>Back</a>
                </div>
                <div class="title-page text-white my-5">
                    <h1 class="fw-light">Daftar</h1>
                    <h1 class="fw-bold">Alumni</h1>
                </div>

                <div class="alumni-table">
                    <!-- SEARCH BAR -->
                    <div class="search py-3">
                        <form action="{{route('admin.alumni.list')}}" method="GET" class="position-relative">
                            <i class='bx bx-search position-absolute'></i>
                            <div class="input-group mb-3 px-5">
                                <input type="text" class="form-control rounded-20 shadow" placeholder="Search Alumni..."
                                    value="" name="keyword">
                            </div>
                        </form>
                    </div>
                    <div class="data-table rounded-20 p-2 bg-white">
                        <!-- HEADER ALAT ALAT -->
                        <div class="header d-flex justify-content-between mb-3">
                            <button class="btn btn-primary rounded-20 dropdown-toggle" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">10</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">10</a></li>
                                <li><a class="dropdown-item" href="#">20</a></li>
                                <li><a class="dropdown-item" href="#">30</a></li>
                            </ul>
                            <a href="{{route('admin.alumni.create')}}" class="btn btn-primary rounded-20"><i class='bx bxs-plus-circle align-middle'></i>
                                <p class="d-inline align-middle">Add</p>
                            </a>
                        </div>
                        @if (\Session::has('success'))
                        <div>
                            <div class="alert alert-success" role="alert">
                                {!! \Session::get('success') !!}
                            </div>
                        </div>
                        @endif
                        @if (\Session::has('fail'))
                        <div>
                            <div class="alert alert-danger" role="alert">
                                {!! \Session::get('fail') !!}
                            </div>
                        </div>
                        @endif
                        <!-- ISI DATA KE TABEL -->
                        <div class="content mb-2">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">NISN</th>
                                        <th scope="col">Angkatan</th>
                                        <th scope="col">Jurusan</th>
                                        <th scope="col">~</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @foreach ($data_alumni as $alumni)
                                    <tr>
                                        <th scope="row">{{$id++}}</th>
                                        <td><a href="/ad/al/detail/{{encrypt($alumni->id_alumni)}}" class="text-link-black text-decoration-none">{{$alumni->nama}}</a></td>
                                        <td>{{$alumni->nis}}</td>
                                        <td>{{$alumni->nisn}}</td>
                                        <td>
                                            <a href="{{route('admin.alumni', encrypt($alumni->angkatan_id))}}" class="text-link-black text-decoration-none">{{$alumni->angkatan->angkatan}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.penelusuran.jurusan', $alumni->jurusan->nama)}}" class="text-link-black text-decoration-none">{{$alumni->jurusan->akronim}}</a>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{route('admin.alumni.edit', encrypt($alumni->id_alumni))}}" data-toggle="tooltip" data-placement="bottom" title="Ubah Data Alumni"><i class="bx bx-edit text-warning tols"></i></a>
                                                </div>
                                                <div class="col">
                                                    <button class="rounded-15" onclick="deleteData('{{$alumni->id_alumni}}')" type="submit" data-toggle="tooltip" data-placement="bottom" title="Hapus Data Alumni"><i class="bx bx-trash-alt text-danger"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        </div>
    </div>
@endsection
@section('script')
    <!-- SWEETALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteData(id) {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data tidak dapat dikembalikan setelah dihapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('/ad/al/delete') }}" + '/' + id, ///ubah
                            type: "POST",
                            data: {
                                '_method': 'POST'
                            },
                            success: function() {
                                swal({
                                    title: "Success!",
                                    text: "Redirecting in 2 seconds.",
                                    icon: "success",
                                    timer: 2000,
                                    button: true
                                }).then(function() {
                                    window.location.replace("http://127.0.0.1:8000/ad/al/list"); ///ubah
                                });
                            },
                            error: function() {
                                swal({
                                    title: 'Opps...',
                                    text: 'Ada masalah saat menghapus data.',
                                    icon: 'error',
                                    timer: '1500'
                                })
                            }
                        })
                    } else {
                        swal("File tidak dihapus!");
                    }
                });
        }
    </script>
@endsection
