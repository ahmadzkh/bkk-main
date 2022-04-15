@extends('templates.main')
@section('title', 'BKK 1 | Dashboard Admin')
@section('css')
    <link rel="stylesheet" href="{{asset ('/assets/css/style.css')}}">

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
    </style>
@endsection
@section('container')
    <div class="main-page">
        @include('partials.sidebar-admin')

    <img src="{{asset ('/assets/img/wave2.svg')}}" class="position-absolute waves">

        <div class="py-3 content-wrapper">
            <div class="title-page text-white my-5">
                <h1 class="fw-light">Daftar</h1>
                <h1 class="fw-bold">Akun</h1>
            </div>

            <div class="alumni-table">
                <div class="search py-3">
                    <form action="" class="position-relative">
                        <i class='bx bx-search position-absolute'></i>
                        <div class="input-group mb-3 px-5">
                            <form action="" method="get">
                                <input name="keyword" type="text" class="form-control rounded-20 shadow" placeholder="Search Alumni...">
                                <button type="submit" hidden></button>
                            </form>
                        </div>
                    </form>
                </div>
                <div class="data-table rounded-20 p-2">
                    <div class="header d-flex justify-content-between mb-3">
                        <button class="btn btn-primary rounded-20 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">10</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">10</a></li>
                            <li><a class="dropdown-item" href="#">20</a></li>
                            <li><a class="dropdown-item" href="#">30</a></li>
                        </ul>
                    </div>
                    <div class="content mb-2">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">~</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $id = 1;
                                @endphp
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$id++}}</th>
                                    @if ($user->username == null)
                                    <td>-</td>
                                    @else
                                    <td>{{$user->username}}</td>
                                    @endif
                                    @if ($user->email == null)
                                    <td>-</td>
                                    @else
                                    <td>{{$user->email}}</td>
                                    @endif
                                    <td>{{$user->level->nama}}</td>
                                    <td>
                                        <a href="{{route('admin.users.edit', encrypt($user->id))}}"><i class="bx bx-edit"></i></a>
                                        <a href="{{route('admin.users.delete', encrypt($user->id))}}"><i class="bx bx-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav class="d-flex justify-content-end">
                            <ul class="pagination rounded-20">
                                <li class="page-item"><a class="page-link" href="#"><i class='bx bx-chevron-left align-middle'></i></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class='bx bx-chevron-right align-middle'></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- SWEETALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function swalDelete() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
    }
</script>
@endsection
