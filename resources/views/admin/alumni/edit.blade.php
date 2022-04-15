@extends('templates.main')
@section('title', 'BKK 1 | Dashboard Admin')
@section('css')
    <link rel="stylesheet" href="{{asset ('/assets/css/style.css')}}">
    <style>
        .title-page h1.fw-bold {
            margin-bottom: 120px;
        }
        .edit-wrapper .data form {
            width: 50vw;
        }
        .edit-wrapper .data form button {
            width: 100px;
        }
        .edit-wrapper .preview {
            width: 45vw;
        }
        .edit-wrapper .preview .content table {
            width: 100%;
        }
        .edit-wrapper .preview .header {
            border-radius: 15px 15px 0px 0px;
            width: 100%;
            background-image: linear-gradient(to right, #96aeff, #3759d6);
            height: 100px;
        }
        .edit-wrapper .preview .header .img {
            border: 4px solid #fff;
            width: 120px;
            height: 120px;
            background: rgb(128, 128, 128);
            top: 30px;
            left: 20px;
        }
        /* STYLING CUSTOM FILE INPUT */
        .edit-wrapper .preview .header .img #uploadPhoto {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }
        .edit-wrapper .preview .header .img label {
            cursor: pointer;
            color: #fff;
            font-size: 60px;
        }
        .edit-wrapper .preview .header .upload-image {
            visibility: hidden;
        }
        .edit-wrapper .preview .header .img:hover .upload-image {
            visibility: visible;
        }
    </style>
@endsection

@section('container')
    <div class="main-page">
        @include('partials.sidebar-admin')

        <img src="{{asset ('/assets/img/wave2.svg')}}" class="position-absolute waves">

        <div class="content-outer-wrapper mx-auto">
            <div class="container py-3 content-wrapper">
                <!-- TITLE -->
                <div class="title-back">
                    <a href="{{ URL::previous() }}" class="d-flex align-items-center text-decoration-none text-white"><i
                            class='bx bx-left-arrow-alt'></i>Back</a>
                </div>
                <div class="title-page text-white my-5">
                    <h1 class="fw-light">Ubah</h1>
                    <h1 class="fw-bold">Alumni</h1>
                </div>

                <div class="edit-wrapper d-flex mb-5">
                    <div class="data me-4 bg-white rounded-15 px-4 py-3">
                        <h3 class="fw-700 mb-2">Data Alumni</h3>
                        <!-- FORM INPUTANNYA -->
                        <form action="{{route('admin.alumni.update', encrypt($alumni->id_alumni))}}" method="POST" class="">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control rounded-15 @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Lengkap Alumni" onkeyup="updateNama(this.value)" name="nama" value="{{$alumni->nama}}">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="number" class="form-control rounded-15 @error('nis') is-invalid @enderror" id="nis" onkeyup="updateNis(this.value)" placeholder="NIS Alumni" maxlength="12" name="nis" value="{{$alumni->nis}}">
                                @error('nis')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" class="form-control rounded-15 @error('nisn') is-invalid @enderror" id="nisn"  onkeyup="updateNisn(this.value)" placeholder="NISN Alumni" maxlength="12" name="nisn" value="{{$alumni->nisn}}">
                                @error('nisn')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select class="form-select rounded-15 @error('jurusan') is-invalid @enderror" onchange="updateJur(this.value)" name="jurusan">
                                    <option hidden>Alumni Jurusan</option>
                                    @foreach ($jurusan as $jurusan)
                                    <option value="{{$jurusan->id_jurusan}}" @if ($jurusan->id_jurusan === $alumni->jurusan_id)
                                        {{'selected'}}
                                    @endif>{{$jurusan->nama}}</option>
                                    @endforeach
                                </select>
                                @error('jurusan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="angakatan" class="form-label">Angakatan</label>
                                <select class="form-select rounded-15 @error('angkatan') is-invalid @enderror" onchange="updateAng(this.value)" name="angkatan">
                                    <option hidden>Alumni Angakatan</option>
                                    @foreach ($angkatan as $ang)
                                    <option value="{{$ang->id_angkatan}}" @if ($ang->id_angkatan === $alumni->angkatan_id)
                                        {{'selected'}}
                                    @endif>{{$ang->angkatan}}</option>
                                    @endforeach
                                </select>
                                @error('angkatan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="blue-line rounded-20 mb-3"></div>
                            <h3 class="fw-700 mb-2">Data Akun</h3>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control rounded-15" id="username" placeholder="NIS Alumni"
                                    name="username" value="{{$alumni->user_id}}" disabled>
                                <input type="text" class="form-control rounded-15" id="username" placeholder="Username"
                                    name="username" value="{{$alumni->user_id}}" hidden>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Old Password</label>
                                <input type="password" class="form-control rounded-15" id="username" placeholder="Password" name="oldPassword" value="{{$alumni->user->password}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control rounded-15" id="username" placeholder="Password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <input type="text" class="form-control rounded-15" id="level" name="level" value="Alumni" readonly>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{URL::previous()}}" class="btn btn-secondary fw-700 rounded-15 me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary fw-700 rounded-15">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- BAGIAN PREVIEW -->
                    <div class="preview">
                        <h2 class="fw-700 mb-2">Preview</h2>
                        <div class="shadow bg-white rounded-20">
                            <div class="header position-relative mb-5">
                                <div class="img rounded-circle position-absolute d-flex justify-content-center align-items-center overflow-hidden">
                                    @if ($alumni->foto === null)
                                    <img src="{{asset ('/assets/img/default-profile.png')}}" id="imagePreview" width="120" draggable="false">
                                    @else
                                    <img src="{{asset ('/assets/img/'.$alumni->foto)}}" id="imagePreview" width="120" draggable="false">
                                    @endif
                                </div>
                            </div>
                            <div class="content p-3">
                                <div>
                                    <h4 class="fw-bold" id="nama_value">{{$alumni->nama}}</h4>
                                </div>
                                <!-- TABLE PREVIEW -->
                                <table>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">NIS</p>
                                                <p id="nis_value">{{$alumni->nis}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="fw-bold">NISN</p>
                                                <p id="nisn_value">{{$alumni->nisn}}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Jurusan</p>
                                                <p id="jurusan_value">{{$alumni->jurusan->nama}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Angakatan</p>
                                                <p id="angakatan_value">{{$alumni->angkatan->angkatan}}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="blue-line rounded-20 mb-3"></div>
                                <table>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Username</p>
                                                <p id="nis_value">{{$alumni->user->username}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Level</p>
                                                <p id="nisn_value">Alumni</p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- SCIPRT BUAT PREVIEW -->
    <script>
        uploadPhoto.onchange = evt => {
            const [file] = uploadPhoto.files;
            let label = document.getElementById("labelPhoto");
            let input = document.getElementById("uploadPhoto");
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
            }
        }
        function updateNama(data) {
            document.getElementById("nama_value").innerHTML = data;
        }
        function updateNis(data) {
            document.getElementById("nis_value").innerHTML = data;
        }
        function updateNisn(data) {
            document.getElementById("nisn_value").innerHTML = data;
        }
        function updateJur(data) {
            document.getElementById("jurusan_value").innerHTML = data;
        }
        function updateAng(data) {
            document.getElementById("angakatan_value").innerHTML = data;
        }
        function updateTahunmsk(data) {
            document.getElementById("tahunmasuk_value").innerHTML = data;
        }
        function updateTahunlls(data) {
            document.getElementById("tahunlulus_value").innerHTML = data;
        }
    </script>
@endsection
