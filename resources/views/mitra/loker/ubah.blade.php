@extends('templates.main')

@section('title', 'Ubah Loker | Mitra')

@section('css')
    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/styleMitra.css">
    <!-- TEXTAREA EDITOR -->
    {{-- <script src="{{ asset('/assets/js/ckeditor.js') }}"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>

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
        .edit-wrapper .preview .content .req {
            font-size: 16px;
        }
        .edit-wrapper .preview .content .posted {
            font-size: 14px;
        }
        /* STYLING CUSTOM FILE INPUT */
        .edit-wrapper .data .image {
            background: rgb(187, 187, 187);
            width: 100px;
            height: 100px;
        }
        .edit-wrapper .data .image #uploadPhoto {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }
        .edit-wrapper .data .image label {
            z-index: 10;
            width: 100%;
            height: 100%;
            cursor: pointer;
            color: #fff;
            font-size: 60px;
            top: 10px;
            left: 0;
        }
        /* STYLING TEXTAREA EDITOR */
        .edit-wrapper .data .image:hover .upload-image {
            visibility: visible;
        }
        .loker-preview .bottom p {
            font-size: 14px;
        }
        .edit-wrapper .data .delete-image {
            z-index: 10;
            position: absolute;
            top: 0;
            left: 0;
        }
        .edit-wrapper .data .icon-hover i {
            visibility: hidden;
        }
        .edit-wrapper .data .icon-hover:hover i {
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
            .edit-wrapper .data .image {
                width: 50px;
                height: 50px;
            }
            .edit-wrapper .data .image img {
                width: 50px;
            }
            .edit-wrapper .data .image label {
                font-size: 25px;
            }
            .search input {
                font-size: 14px;
            }
        }
    </style>
@endsection

@section('container')
    @include('partials.navbar-mitra')

    <div class="main-page">
        <!-- SIDEBAR -->
        @include('partials.sidebar-mitra')

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="position-absolute waves"
            preserveAspectRatio="none">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,288L60,282.7C120,277,240,267,360,234.7C480,203,600,149,720,149.3C840,149,960,203,1080,213.3C1200,224,1320,192,1380,176L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg>

        <div class="container-lg py-3 content-wrapper">
            <!-- TITLE HALAMAN -->
            <div class="title-back">
                <a href="/mt/lk/main" class="d-flex align-items-center text-decoration-none text-white"><i
                        class='bx bx-left-arrow-alt'></i>Back</a>
            </div>
            <div class="title-page text-white my-5">
                <h1 class="fw-light">Ubah</h1>
                <h1 class="fw-bold">Lowongan Kerja</h1>
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
                <div class="data me-lg-4 bg-white rounded-15 p-2 mb-4 mb-lg-0">
                    <!-- DATA INPUTAN -->
                    <h2 class="fw-700 mb-2">Data</h2>
                    <form action="/mt/lk/ubah/post" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="loker_id" value="{{ $loker->id_lowongankerja }}">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control rounded-15 @error('title') is-invalid @enderror"
                                id="title" placeholder="Title..." name="title" value="{{ $loker->title }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control rounded-15 @error('posisi') is-invalid @enderror"
                                id="posisi" placeholder="Posisi..." onkeyup="updatePos(this.value)" name="posisi"
                                value="{{ $loker->posisi }}">
                            @error('posisi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select rounded-15 @error('kategori') is-invalid @enderror" id="kategori"
                                name="kategori" onchange="updateKat(this.value)">
                                <option selected disabled hidden>Pilih Kategori</option>
                                <option @if ($loker->kategori == 'Information and Technologies') {{ 'selected ' }} @endif
                                    value="Information and Technologies">
                                    Information and Technologies</option>
                                <option @if ($loker->kategori == 'Software Engineering') {{ 'selected ' }} @endif
                                    value="Software Engineering">Software Engineering</option>
                                <option @if ($loker->kategori == 'Automotive') {{ 'selected ' }} @endif value="Automotive">
                                    Automotive</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-select rounded-15 @error('jurusan') is-invalid @enderror" id="jurusan"
                                name="jurusan">
                                <option selected disabled hidden>Pilih Jurusan</option>
                                @foreach ($jurusan as $jur)
                                    <option @if ($loker->jurusan_id == $jur->id_jurusan) {{ 'selected ' }} @endif
                                        value="{{ $jur->id_jurusan }}">{{ $jur->nama }}</option>
                                @endforeach
                            </select>
                            @error('jurusan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenisPekerjaan" class="form-label">Jenis Pekerjaan</label>
                            <select class="form-select rounded-15 @error('jenis_pekerjaan') is-invalid @enderror"
                                id="jenisPekerjaan" name="jenis_pekerjaan">
                                <option selected disabled hidden>Pilih Jenis Pekerjaan</option>
                                <option @if ($loker->jenis_pekerjaan == 'Part-Time') {{ 'selected ' }} @endif value="Part-Time">
                                    Part-Time</option>
                                <option @if ($loker->jenis_pekerjaan == 'Full-Time') {{ 'selected ' }} @endif value="Full-Time">
                                    Full-Time</option>
                            </select>
                            @error('jenis_pekerjaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="number" class="form-control rounded-15 @error('kuota') is-invalid @enderror"
                                id="kuota" placeholder="Kuota..." name="kuota" value="{{ $loker->kuota }}">
                            @error('kuota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gaji" class="form-label">Gaji</label>
                            <input type="number" class="form-control rounded-15 @error('gaji') is-invalid @enderror"
                                id="gaji" placeholder="Gaji..." name="gaji" value="{{ $loker->gaji }}" readonly>
                            @error('gaji')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_kerja" class="form-label">Lokasi Kerja</label>
                            <select class="form-select rounded-15 @error('kantor') is-invalid @enderror"
                                id="kantor" name="kantor" onchange="updateLok(this.value)">
                                <option selected disabled hidden>Pilih Lokasi Kerja</option>
                                @foreach ($kantor as $lok)
                                    <option @if ($loker->kantor_id == $lok->id_kantor) {{ 'selected ' }} @endif
                                        value="{{ $lok->id_kantor }}">{{$lok->alamat }} - {{ $lok->status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kantor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="expired" class="form-label">Expired</label>
                            <input type="date" class="form-control rounded-15 @error('kedaluwarsa') is-invalid @enderror"
                                id="expired" placeholder="Expired..." name="kedaluwarsa"
                                value="{{ $loker->kedaluwarsa }}" readonly>
                            @error('kedaluwarsa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="old_banner" value="{{ $loker->banner }}">
                            <label for="banner" class="form-label" id="bannerLabel">Image for banner</label>
                            <input type="file" class="form-control rounded-15 @error('banner') is-invalid @enderror"
                                id="bannerImg" name="banner">
                            @error('banner')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mt-2" id="imgbannerPrev"><img src="/assets/img/mitra/{{ $loker->banner }}"
                                    class="w-100 rounded-20" id="bannerPrev" draggable="false" alt=""></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Images</label>
                            <div class="d-flex">
                                @foreach ($galeri as $key => $gal)
                                    @php
                                        $key++;
                                    @endphp
                                    <div class="d-block">
                                        <div
                                            class="image rounded-20 text-center overflow-hidden position-relative me-1 mb-2">
                                            <img src="/assets/img/galeri/{{ $gal->foto }}"
                                                id="imagePreview{{ $key }}" width="100" draggable="false" alt="">
                                            <div class="upload-image" id="uploadImage{{ $key }}">
                                                <label for="uploadPhoto{{ $key }}"
                                                    id="labelPhoto{{ $key }}" class="position-absolute"><i
                                                        class='bx bxs-image-add'></i></label>
                                                <input type="file" name="old_fotos[]" id="uploadPhoto{{ $key }}"
                                                    accept="image/*" class="d-none">
                                            </div>
                                            <input type="hidden" name="old_fotos[]" id="hidden_fotos{{ $key }}"
                                                value="{{ $gal->foto }}">
                                            <input type="hidden" name="id_fotos[]" id="hidden_fotos{{ $key }}"
                                                value="{{ $gal->id_galeri }}">
                                        </div>
                                        <div class="delete-wrapper text-center">
                                            <button type="button" onclick="deleteButton('{{ $key }}')"
                                                class="btn btn-danger rounded-15 py-1 px-2 delete-img"><i
                                                    class='bx bxs-trash-alt'></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @for ($i = count($galeri) + 1; $i <= 5; $i++)
                                    <div class="image rounded-20 text-center overflow-hidden position-relative me-1">
                                        <img src="" id="imagePreview{{ $i }}" width="100" draggable="false">
                                        <div class="upload-image" id="uploadImage{{ $i }}">
                                            <label for="uploadPhoto{{ $i }}" id="labelPhoto{{ $i }}"
                                                class="position-absolute"><i class='bx bxs-image-add'></i></label>
                                            <input type="file" name="fotos[]" id="uploadPhoto{{ $i }}"
                                                accept="image/*" class="d-none">
                                        </div>
                                    </div>
                                @endfor
                                <script>
                                    for (let i = 1; i <= 5; i++) {
                                        let imgPrev = document.getElementById('imagePreview' + i);
                                        if (document.getElementById('uploadPhoto' + i).files > 0 || imgPrev.getAttribute('src') != '') {
                                            document.getElementById('labelPhoto' + i).classList.add('icon-hover');
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                        <div id="req-wrapper">
                            {{-- DISPLAY ERROR --}}
                            @error('req')
                                <div class="alert alert-danger rounded-15">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- <div id="main-req"> -->
                            <label class="form-label">Requirements</label>
                            @foreach ($reqs as $key => $req)
                                @php
                                    $key++;
                                @endphp
                                <div class="mb-2 d-flex">
                                    <input type="text" class="form-control rounded-15 me-2"
                                        id="requirement{{ $key }}"
                                        placeholder="Requirement {{ $key }}..." name="req[]"
                                        value="{{ $req->text }}">
                                    <input type="hidden" name="id_req[]" value="{{ $req->id_persyaratan }}">
                                    <div class="delete-req">
                                        <button type="button" class="btn btn-danger rounded-15"
                                            onclick="deleteReq('{{ $key }}')">-</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <span class="btn btn-primary rounded-15 mb-3" onclick="addReq()">Tambah Persyaratan</span>
                        <div class="mb-3">
                            <!-- EDITOR CK EDITOR 5 -->
                            <label for="editor" class="mb-2">Deskripsi</label>
                            <textarea name="deskripsi" id="editor">{!! $loker->deskripsi !!}</textarea>
                        </div>
                        <div class="blue-line rounded-20 mb-3"></div>
                        <div id="section-wrapper" class="mb-2">
                            {{-- DISPLAY ERROR --}}
                            @if ($errors->has('tahapsec') || $errors->has('namasec'))
                                <div class="alert alert-danger rounded-15">
                                    <ul>
                                        @foreach ($errors->get('tahapsec') as $errTah)
                                            <li>{{ $errTah }}</li>
                                        @endforeach
                                        @foreach ($errors->get('namasec') as $errNam)
                                            <li>{{ $errNam }}</li>
                                        @endforeach
                                        @foreach ($errors->get('datesec') as $errDat)
                                            <li>{{ $errDat }}</li>
                                        @endforeach`
                                    </ul>
                                </div>
                            @endif
                            @foreach ($tahap as $key => $val)
                                <div>
                                    <div class="mb-2">
                                        <label class="form-label">Tahap {{ $key + 1 }}</label>
                                        <input type="number" class="form-control rounded-15" id="sec"
                                            placeholder="Tahap Ke..." name="tahapsec[]" value="{{ $val->tahap_ke }}">
                                        <input type="hidden" name="id_tahap[]" value="{{ $val->id_tahap }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Nama Tahap</label>
                                        <input type="text" class="form-control rounded-15" id="namasec"
                                            placeholder="Nama Tahap..." name="namasec[]" value="{{ $val->nama }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Tanggal Tahap Dimulai</label>
                                        <input type="date" class="form-control rounded-15" id="datesec" name="datesec[]"
                                            value="{{ $val->tanggal_seleksi }}">
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                        <span class="btn btn-primary rounded-15 mb-3" onclick="addSec()">Tambah
                            Tahap</span>
                        <div class="d-flex justify-content-end btn-action">
                            <button class="btn btn-secondary fw-700 rounded-15 me-2" type="button">Cancel</button>
                            <button class="btn btn-primary fw-700 rounded-15" type="submit">Save</button>
                        </div>
                </div>
                <!-- HASIL PREVIEW -->
                <div class="preview mt-4">
                    <h2 class="fw-700 mb-2">Preview</h2>
                    <div class="loker-preview p-4 bg-white rounded-15 shadow">
                        <div class="img mb-3">
                            <img src="{{ $urlImg.$loker->mitra->foto }}"
                                width="120px" class="rounded-15" alt="">
                        </div>
                        <div class="title">
                            <h4 class="fw-900 mb-0 text-primary" id="position_value">{{ $loker->posisi }}</h4>
                            <h6 class="mb-3">{{ $loker->mitra->jenis }}. {{ $loker->mitra->nama }}</h6>
                            <h6 class="fw-900 mb-3">{{ $loker->mitra->wilayah }}</h6>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="fw-bold mb-0">Kategori</p>
                                <p id="kategori_value">{{ $loker->kategori }}</p>
                            </div>
                            <div class="col-6">
                                <p class="fw-bold mb-0">Lokasi Kerja</p>
                                <p id="lokasi_kerja_value">{{ $loker->lokasi_kerja }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="bottom">
                            <p class="text-secondary mb-0">{{\Carbon\Carbon::parse($loker->created_at)->diffForHumans()}}</p>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        var newReqNum = {{ $reqs->count() }};
        function addReq() {
            newReqNum += 1;
            var req = document.createElement('div');
            req.innerHTML =
                "<div class=\"mb-2 d-flex\"><input type=\"text\" class=\"form-control rounded-15 me-2\" id=\"requirement" +
                newReqNum + "\" placeholder=\"Requirement " + newReqNum +
                "...\" name=\"req[]\"><div class=\"delete-req\"><button type=\"button\" class=\"btn btn-danger rounded-15\" onclick=\"deleteReq('" +
                newReqNum + "')\">-</button></div></div>";
            var wrapper = document.getElementById('req-wrapper');
            wrapper.appendChild(req);
        }
        // MENAMBAH TAHAP JIKA DIKLIK
        let newSecNum = {{ $tahap->count() }};
        function addSec() {
            newSecNum += 1;
            var newSec = document.createElement('div');
            newSec.innerHTML = "<div class=\"mb-4\"><div class=\"mb-2\"><label class=\"form-label\">Tahap " + newSecNum +
                "</label><input type=\"number\" class=\"form-control rounded-15\" id=\"sec" + newSecNum +
                "\" placeholder=\"Tahap Ke...\" name=\"tahapsec[]\"></div><div class=\"mb-2\"><label class=\"form-label\">Nama Tahap</label><input type=\"text\" class=\"form-control rounded-15\" id=\"namasec" +
                newSecNum +
                "\" placeholder=\"Nama Tahap...\" name=\"namasec[]\"></div><div class=\"mb-2\"><label class=\"form-label\">Tanggal Tahap Dimulai</label><input type=\"date\" class=\"form-control rounded-15\" id=\"datesec" +
                newSecNum + "\" name=\"datesec[]\"></div><hr>";
            var wrapper = document.getElementById('section-wrapper');
            wrapper.appendChild(newSec);
        }
        // MANGGIL CK EDITOR
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
        // BANNER
        bannerImg.onchange = evt => {
            const [file] = bannerImg.files;
            let label = document.getElementById("bannerLabel");
            let input = document.getElementById("bannerImg");
            var divPrev = document.getElementById("imgbannerPrev");
            if (file) {
                bannerPrev.src = URL.createObjectURL(file);
                imgPreview.src = URL.createObjectURL(file);
                divPrev.classList.add("my-3");
            }
        }
        // UPLOAD GAMBAR 1 2 3 4 5
        uploadPhoto1.onchange = evt => {
            const [file] = uploadPhoto1.files;
            let label = document.getElementById("labelPhoto1");
            let input = document.getElementById("uploadPhoto1");
            document.getElementById('labelPhoto1').classList.add('icon-hover')
            if (file) {
                imagePreview1.src = URL.createObjectURL(file);
            }
        }
        uploadPhoto2.onchange = evt => {
            const [file] = uploadPhoto2.files;
            let label = document.getElementById("labelPhoto2");
            let input = document.getElementById("uploadPhoto2");
            document.getElementById('labelPhoto2').classList.add('icon-hover')
            if (file) {
                imagePreview2.src = URL.createObjectURL(file);
            }
        }
        uploadPhoto3.onchange = evt => {
            const [file] = uploadPhoto3.files;
            let label = document.getElementById("labelPhoto3");
            let input = document.getElementById("uploadPhoto3");
            document.getElementById('labelPhoto3').classList.add('icon-hover')
            if (file) {
                imagePreview3.src = URL.createObjectURL(file);
            }
        }
        uploadPhoto4.onchange = evt => {
            const [file] = uploadPhoto4.files;
            let label = document.getElementById("labelPhoto4");
            let input = document.getElementById("uploadPhoto4");
            document.getElementById('labelPhoto4').classList.add('icon-hover')
            if (file) {
                imagePreview4.src = URL.createObjectURL(file);
            }
        }
        uploadPhoto5.onchange = evt => {
            const [file] = uploadPhoto5.files;
            let label = document.getElementById("labelPhoto5");
            let input = document.getElementById("uploadPhoto5");
            document.getElementById('labelPhoto5').classList.add('icon-hover')
            if (file) {
                imagePreview5.src = URL.createObjectURL(file);
            }
        }
        // SET DAN GET DATA DARI INPUTAN
        function updatePos(data) {
            document.getElementById("position_value").innerHTML = data;
        }
        function updateKat(data) {
            document.getElementById("kategori_value").innerHTML = data;
        }
        function updateLok(data) {
            document.getElementById("lokasi_kerja_value").innerHTML = data;
        }
        function deleteButton(id) {
            document.getElementById('hidden_fotos' + id).value = '';
            document.getElementById('imagePreview' + id).src = '';
            document.getElementById('labelPhoto' + id).classList.remove('icon-hover')
        }
        function deleteReq(id) {
            document.getElementById('requirement' + id).value = '';
            console.log('iya jalan' + id);
        }
    </script>
@endsection
