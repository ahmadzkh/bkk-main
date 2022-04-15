@extends('templates.main')

@section('titlepage', 'Ubah Profil | Mitra')

@section('css')
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/styleMitra.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

    <style>
        /* CUSTOMIZING NAVBAR */
        .ck-file-dialog-button {
            display: none;
        }
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
                <a href="{{ url()->previous() }}" class="d-flex align-items-center text-decoration-none text-white"><i
                        class='bx bx-left-arrow-alt'></i>Back</a>
            </div>
            <div class="title-page text-white mb-5">
                <h1 class="fw-light">Ubah</h1>
                <h1 class="fw-bold">Profil</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-15">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- KONTEN LUAR -->
            <div class="edit-wrapper d-lg-flex">
                <div class="data me-1 me-lg-4 bg-white rounded-15 p-2">
                    <!-- DATA INPUTAN -->
                    <h2 class="fw-700 mb-2">Data Profil</h2>
                    <form action="/mt/profil/ubahPost" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_mitra" value="{{ $mitra->id_mitra }}">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control rounded-15" id="nama" placeholder="Nama..."
                                onkeyup="updateNama(this.value)" name="nama" value="{{ $mitra->nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="jenis perusahaan" class="form-label">Jenis Perusahaan</label>
                            <select class="form-select rounded-15" onchange="updateJenis(this.value)" name="jenis">
                                <option selected disabled hidden>Pilih Jenis Perusahaan</option>
                                @foreach ($jenis as $item)
                                    <option @if ($mitra->jenis == $item) {{ 'selected ' }} @endif
                                        value="{{ $item }}">
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select rounded-15" onchange="updateKat(this.value)" name="kategori">
                                <option selected disabled hidden>Pilih Kategori</option>
                                @foreach ($kat as $item)
                                    <option @if ($mitra->kategori == $item) {{ 'selected ' }} @endif
                                        value="{{ $item }}">
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="wilayah" class="form-label">wilayah</label>
                            <select class="form-select rounded-15" name="wilayah">
                                <option selected disabled hidden>Pilih Wilayah</option>
                                @foreach ($wil as $item)
                                    <option @if ($mitra->wilayah == $item) {{ 'selected ' }} @endif
                                        value="{{ $item }}">
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="website" class="form-control rounded-15" id="website" placeholder="Website..."
                                name="website" value="{{ $mitra->website }}" autocomplete="website">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control rounded-15" id="email" placeholder="Email..."
                                onkeyup="updateEmail(this.value)" name="email" value="{{ $user->email }}"
                                autocomplete="email">
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="number" class="form-control rounded-15" id="telepon" placeholder="Telepon..."
                                onkeyup="updateTlp(this.value)" name="no_telp"
                                value="{{ $mitra->no_telp ?? 'Default Message' }}">
                        </div>
                        <div class="mb-3">
                            <label for="uploadPhoto" class="form-label">Foto Profile</label>
                            <input type="file" class="form-control rounded-15" id="uploadPhoto"
                                placeholder="Foto Profile..." name="foto" accept="image/*">
                        </div>
                        <div class="img_preview mt-3">
                            <img src="" height="200px" id="img_prev" class="rounded-15 mb-2">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control rounded-15"
                                onkeyup="updateAlamat(this.value)"></textarea>
                        </div> --}}
                        <div class="mb-3">
                            <!-- EDITOR CK EDITOR 5 -->
                            <label for="editor" class="mb-2">Deskripsi</label>
                            <textarea name="deskripsi" id="editor">{{ $mitra->overview }}</textarea>
                        </div>
                        <div class="blue-line rounded-20 mb-3"></div>
                        <h3 class="fw-700 mb-2">Data Akun</h3>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control rounded-15" id="username" placeholder="Username..."
                                name="username" onkeyup="updateUsername(this.value)" value="{{ $mitra->nama }}"
                                autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Change Password</label>
                            <input type="password" class="form-control rounded-15" id="password" placeholder="password"
                                name="password" autocomplete="current-password">
                            <small class="w-100 text-secondary">Kosongkan input jika tidak ingin mengubah password.</small>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmation Password</label>
                            <input type="password" class="form-control rounded-15" id="password_confirmation"
                                placeholder="Confirm Password" name="password_confirmation">
                        </div>
                        <!-- <div class="blue-line rounded-20 mb-3"></div> -->
                        <div class="d-flex justify-content-end btn-action">
                            <a href="/mt/profil" class="btn btn-secondary fw-700 rounded-15 me-2">Cancel</a>
                            <button class="btn btn-primary fw-700 rounded-15">Save</button>
                        </div>
                </div>
                <!-- HASIL PREVIEW -->
                <div class="preview">
                    <h2 class="fw-700 mb-2">Preview</h2>
                    <div class="shadow bg-white rounded-20">
                        <div class="header position-relative mb-5">
                            <div
                                class="img rounded-circle position-absolute d-flex justify-content-center align-items-center overflow-hidden">
                                <img src="{{ $urlImg.$mitra->foto }}" id="imagePreview"
                                    width="120" draggable="false">
                            </div>
                        </div>
                        <div class="content p-3">
                            <div>
                                <h4 class="fw-bold" id="nama_value">{{ $mitra->nama }}</h4>
                            </div>
                            <table>
                                <tr>
                                    <td>
                                        <div>
                                            <p class="fw-bold">Kategori</p>
                                            <p id="kategori_value">{{ $mitra->kategori }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="fw-bold">Jenis Perusahaan</p>
                                            <p id="jenisperusahaan_value">{{ $mitra->jenis }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <p class="fw-bold">No. Telp</p>
                                            <p id="notelp_value">{{ $mitra->no_telp }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <p class="fw-bold">Username</p>
                                            <p id="username_value">{{ $user->username ? $user->username : 'Null' }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="fw-bold">E-mail</p>
                                            <p id="email_value">{{ $user->email }}</p>
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
                    </form>
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
            let input = document.getElementById("uploadPhoto");
            // let img_prev = document.getElementByClassName("img_preview");
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                img_prev.src = URL.createObjectURL(file);
            }
        }
        function updateNama(data) {
            document.getElementById("nama_value").innerHTML = data;
        }
        function updateTlp(data) {
            document.getElementById("notelp_value").innerHTML = data;
        }
        function updateEmail(data) {
            document.getElementById("email_value").innerHTML = data;
        }
        function updateUsername(data) {
            let newUsername = data.replace(/\s+/g, '');
            console.log(newUsername);
            document.getElementById("username_value").innerHTML = newUsername;
            document.getElementById("username").value = newUsername;
        }
        function updateKat(data) {
            document.getElementById("kategori_value").innerHTML = data;
        }
        function updateJenis(data) {
            document.getElementById("jenisperusahaan_value").innerHTML = data;
        }
    </script>
@endsection
