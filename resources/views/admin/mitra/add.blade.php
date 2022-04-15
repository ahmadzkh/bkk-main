@extends('templates.main')

@section('title', 'BKK 1 | Dashboard Admin')

@section('css')
    <link rel="stylesheet" href="{{asset ('/assets/css/style.css')}}">
    <!-- TEXTAREA EDITOR -->
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

    <style>
        /* STYLING TITLE PAGE */
        .title-page h1.fw-bold {
            margin-bottom: 120px;
        }
        /* WRAPPER FORM */
        .edit-wrapper .data form {
            width: 50vw;
        }
        .edit-wrapper .data form .btn-action button {
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
            height: 200px;
        }
        /* STYLING CUSTOM FILE INPUT */
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
            /* Style as you please, it will become the visible UI component. */
        }
        .edit-wrapper .preview .header .upload-image {
            visibility: hidden;
        }
        .edit-wrapper .preview .header .img:hover .upload-image {
            visibility: visible;
        }
        /* STYLING TEXTAREA EDITOR */
        :root {
            --ck-border-radius: 5px;
        }
    </style>
@endsection
@section('container')
    <div class="main-page">
        <!-- SIDEBAR -->
        @include('partials.sidebar-admin')

        <img src="{{asset ('/assets/img/wave2.svg')}}" class="position-absolute waves">

        <div class="content-outer-wrapper mx-auto">
            <div class="container py-3 content-wrapper">
                <!-- TITLE HALAMAN -->
                <div class="title-back">
                    <a href="{{ URL::previous() }}" class="d-flex align-items-center text-decoration-none text-white">
                        <i class='bx bx-left-arrow-alt'></i>Back
                    </a>
                </div>
                <div class="title-page text-white my-5">
                    <h1 class="fw-light">Tambah</h1>
                    <h1 class="fw-bold">Mitra</h1>
                </div>

                <!-- KONTEN LUAR -->
                <div class="edit-wrapper d-flex">
                    <div class="data me-4 bg-white rounded-15 px-4 py-3">
                        <!-- DATA INPUTAN -->
                        <h2 class="fw-700 mb-2">Data Mitra</h2>
                        <form action="{{route('admin.mitra.store')}}" method="POST" class="" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control rounded-15" id="nama" placeholder="Nama Perusahaan" onkeyup="updateNama(this.value)" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis perusahaan" class="form-label">Jenis Perusahaan</label>
                                <select class="form-select rounded-15" onchange="updateJenis(this.value)" name="jenis">
                                    <option hidden>Pilih Jenis Perusahaan</option>
                                    @foreach ($jenis as $item)
                                        <option value="{{$item}}" @if (old('jenis') === $item)
                                            {{'selected'}}
                                        @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('jenis')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select rounded-15" onchange="updateKategori(this.value)" name="kategori">
                                    <option selected disabled hidden>Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item }}" @if (old('kategori') === $item)
                                            {{'selected'}}
                                        @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="wilayah" class="form-label">Wilayah</label>
                                <select class="form-select rounded-15" onchange="updateWilayah(this.value)" name="wilayah">
                                    <option selected disabled hidden>Pilih Wilayah</option>
                                    @foreach ($wilayah as $item)
                                        <option value="{{$item}}" @if (old('wilayah') === $item)
                                            {{'selected'}}
                                        @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('wilayah')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control rounded-15" id="website" placeholder="Alamat Website" name="website" value="{{ old('website') }}" onkeyup="updateWebsite(this.value)">
                                @error('website')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control rounded-15" id="telepon" placeholder="Nomor Telepon" onkeyup="updateTlp(this.value)" name="no_telp" value="{{ old('no_telp') }}">
                                @error('no_telp')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            {{-- DATA AKUN --}}
                            <div class="blue-line rounded-20 mb-3"></div>
                            <h3 class="fw-700 mb-2">Data Akun</h3>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control rounded-15" id="email_input" placeholder="Email" name="email" onkeyup="updateEmail(this.value)" value="{{old('email')}}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control rounded-15" id="password_input" placeholder="Password" name="password" onkeyup="updatePassword(this.value)" value="{{old('password')}}">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <input type="text" class="form-control rounded-15" id="level" value="LVL00003" placeholder="Mitra" name="level" readonly>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{URL::previous()}}" class="btn btn-secondary fw-700 rounded-15 me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary fw-700 rounded-15">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- HASIL PREVIEW -->
                    <div class="preview">
                        <h2 class="fw-700 mb-2">Preview</h2>
                        <div class="shadow bg-white rounded-20">
                            <div class="header position-relative mb-5">
                                <div
                                    class="img rounded-circle position-absolute d-flex justify-content-center align-items-center overflow-hidden">
                                    <img src="{{asset('/assets/img/default-profile.png')}}" id="imagePreview" width="120" draggable="false">
                                </div>
                            </div>
                            <div class="content p-3">
                                <div>
                                    <h4 class="fw-bold mb-4" id="nama_value">Name</h4>
                                </div>
                                <table>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Jenis Perusahaan</p>
                                                <p id="jenis_value">-</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Kategori</p>
                                                <p id="kategori_value">-</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Wilayah</p>
                                                <p id="wilayah_value">-</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Website</p>
                                                <p id="website_value">-</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Nomor Perusahaan</p>
                                                <p id="notelp_value">-</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <!-- <div class="blue-line rounded-20 mb-3"></div> -->
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Email</p>
                                                <p id="email_value">-</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Password</p>
                                                <p id="password_value">-</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="fw-bold">Level</p>
                                                <p>Mitra</p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // MANGGIL CK EDITOR
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
        // IMAGE PROFILE
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
        function updateTlp(data) {
            document.getElementById("notelp_value").innerHTML = data;
        }
        function updateWilayah(data) {
            document.getElementById("wilayah_value").innerHTML = data;
        }
        function updateWebsite(data) {
            document.getElementById("website_value").innerHTML = data;
        }
        function updateAlamat(data) {
            document.getElementById("alamat_value").innerHTML = data;
        }
        function updateEmail(data) {
            document.getElementById("email_value").innerHTML = data;
        }
        function updatePassword(data) {
            document.getElementById("password_value").innerHTML = data;
        }
        function updateKategori(data) {
            document.getElementById("kategori_value").innerHTML = data;
        }
        function updateJenis(data) {
            document.getElementById("jenis_value").innerHTML = data;
        }
    </script>
@endsection
