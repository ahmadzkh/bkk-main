@extends('templates.main')

@section('titlepage', 'Ubah Kantor | Mitra')

@section('css')
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/styleMitra.css">

    <style>
        /* CUSTOMIZING NAVBAR */
        .title-page h1.fw-bold {
            margin-bottom: 120px;
        }
        .navbar-nav .nav-item {
            margin-left: 10px;
            margin-right: 10px;
        }
        .profile i.bx-user-circle {
            font-size: 24px;
            color: #000;
        }
        /* SWAL MODAL FOR DELETE */
        .swal-modal {
            border-radius: 15px;
        }
        /* WRAPPER FORM */
        .edit-wrapper .data form {
            width: 50vw;
        }
        .edit-wrapper .data form .btn-action button,
        .edit-wrapper .data form .btn-action a {
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
        @media only screen and (max-width: 768px) {
            /* UBAH PREVIEW DAN DATA */
            .edit-wrapper .data form {
                width: 100%;
            }
            .edit-wrapper .preview {
                width: 100%;
            }
        }
    </style>
@endsection

@section('container')
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
            <div class="title-back mb-4">
                <a href="/mt/profil" class="d-flex align-items-center text-decoration-none text-white"><i
                        class='bx bx-left-arrow-alt'></i>Back</a>
            </div>
            <div class="title-page text-white mb-5">
                <h1 class="fw-light">Ubah</h1>
                <h1 class="fw-bold">Kantor</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-15">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- KONTEN LUAR -->
            <div class="edit-wrapper d-md-flex">
                <div class="data me-1 me-lg-4 bg-white rounded-15 p-2">
                    <!-- DATA INPUTAN -->
                    <h2 class="fw-700 mb-2">Data Kantor</h2>
                    <form action="/mt/kantor/editPost" method="POST" class="">
                        @csrf
                        <input type="hidden" name="id_kantor" value="{{ $kantor->id_kantor }}">
                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <select class="form-select rounded-15 @error('kota') is-invalid @enderror"
                                onchange="updateKota(this.value)" name="kota">
                                <option selected disabled hidden>Pilih Kota</option>
                                @foreach ($kota as $item)
                                    <option @if ($kantor->wilayah == $item) {{ 'selected' }} @endif
                                        value="{{ $item }}">
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                            <small class="text-secondary">Pilih kota kantor anda berada.</small>
                            @error('kota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" cols="30" rows="5"
                                onkeyup="updateAlamat(this.value)">{{ $kantor->alamat }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="notelp" class="form-label">No. Telp</label>
                            <input type="number" class="form-control rounded-15 @error('notelp') is-invalid @enderror"
                                id="notelp" name="notelp" value="{{ $kantor->no_telp }}" min="0"
                                onkeyup="updateTelp(this.value)">
                            <small class="text-secondary">Ini adalah nomor telepon kantor.</small>
                            @error('notelp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select rounded-15 @error('status') is-invalid @enderror"
                                onchange="updateStatus(this.value)" name="status">
                                <option selected disabled hidden>Pilih Status</option>
                                <option @if ($kantor->status == 'kantor pusat') {{ 'selected ' }} @endif value="kantor pusat">
                                    Kantor Pusat</option>
                                <option @if ($kantor->status == 'kantor cabang') {{ 'selected ' }} @endif value="kantor cabang">
                                    Kantor Cabang</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end btn-action">
                            <a href="/mt/profil" class="btn btn-secondary fw-700 rounded-15 me-2">Cancel</a>
                            <button class="btn btn-primary fw-700 rounded-15">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- HASIL PREVIEW -->
                <div class="preview">
                    <h2 class="fw-700 mb-2">Preview</h2>
                    <div class="shadow bg-white rounded-20">
                        <div class="header position-relative mb-2">
                        </div>
                        <div class="content p-3">
                            <div>
                                <h4 class="fw-bold" id="status_value">{{ ucwords($kantor->status) }}</h4>
                            </div>
                            <table>
                                <tr>
                                    <td>
                                        <div>
                                            <p class="fw-bold">No. Telepon</p>
                                            <p id="notelp_value">{{ $kantor->no_telp }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="fw-bold">Kota</p>
                                            <p id="kota_value">{{ $kantor->kota }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div>
                                            <p class="fw-bold">Alamat</p>
                                            <p id="alamat_value">{{ $kantor->alamat }}</p>
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
@endsection

@section('script')
    <script>
        function updateAlamat(data) {
            document.getElementById("alamat_value").innerHTML = data;
        }
        function updateTelp(data) {
            document.getElementById("notelp_value").innerHTML = data;
        }
        function updateKota(data) {
            document.getElementById("kota_value").innerHTML = data;
        }
        function updateStatus(data) {
            document.getElementById("status_value").innerHTML = data;
        }
    </script>
@endsection
