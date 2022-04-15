@extends('templates.main')
@section('title', 'BKK 1 | Detail Alumni')
@section('css')
<link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}">
<link rel="stylesheet" href="{{asset ('/assets/css/alumni-details.css')}}">
@endsection
@section('container')
    <!-- navbar -->
    <!-- header -->
    <section id="header" class="bg-biru pb-5">
        @include('partials.navbar')
        <div class="container header-wrap d-flex flex-column align-items-center justify-content-end" style="height: 200px">
            <div class="row">
                <div class="col text-center text-lg-start">
                <span class="header-sub ">
                        Detail
                    </span>
                    <br>
                    <span class="header-text">
                        Alumni
                    </span>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <section id="content" class="mt-5">
        <div class="container mx-5">
            <div class="row">
                <div class="col box">
                    <div class="box-sampul">
                    </div>
                    @if ($alumni->foto === null)
                    <img src="{{asset ('/assets/img/default-profile.png')}}" alt="" class="profil-img img-fluid bg-biru" draggable="false">
                    @else
                    <img src="{{asset ('/assets/img/'.$alumni->foto)}}" alt="" class="profil-img img-fluid bg-biru" draggable="false">
                    @endif
                    <div class="px-3 px-lg-5 pb-5">
                        <!-- nama -->
                        <div class="row">
                            <div class="col">
                                <div class="box-title">
                                    {{$alumni->nama}}
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end align-items-end pe-5 pb-3">
                                @if (auth()->user()->level_id === 'LVL00001')
                                <div class="tools d-flex">
                                    <div class="rounded-15 d-flex justify-content-center align-items-center me-1">
                                        <a href="#" class="btn btn-warning text-white"><i class='bx bxs-star'></i></a>
                                    </div>
                                    <div class="rounded-15 d-flex justify-content-center align-items-center me-1">
                                        <a href="{{route('admin.alumni.edit', encrypt($alumni->id_alumni))}}" class="btn btn-warning text-white"><i class='bx bxs-edit'></i></a>
                                    </div>
                                    {{-- TRY TO SOLVE -AKWAN --}}
                                    <div class="rounded-15 d-flex justify-content-center align-items-center">
                                        <button class="rounded-15" onclick="deleteData('{{$alumni->id_alumni}}')" type="submit" data-toggle="tooltip" data-placement="bottom" title="Hapus Data Alumni"><i class="bx bx-trash-alt text-danger"></i></button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- status -->
                        <div class="mb-4 d-flex justify-content-between">
                            <div class="d-flex flex-wrap">
                                @if ($alumni->is_active === '0')
                                <div class="d-flex me-2 mt-2 status-box">
                                    <div class="circle">
                                    </div>
                                    Not Active
                                </div>
                                @elseif ($alumni->is_active === '1')
                                <div class="d-flex me-2 mt-2 status-box">
                                    <div class="circle">
                                    </div>
                                    Active
                                </div>
                                @endif
                                <div class="d-flex me-2 mt-2 status-box">
                                    <div class="circle">
                                    </div>
                                    {{$alumni->jurusan->akronim}}
                                </div>
                                <div class="d-flex me-2 mt-2 status-box">
                                    <div class="circle">
                                    </div>
                                    {{$alumni->angkatan->angkatan}}
                                </div>
                                @if ($alumni->kerja_active === null)
                                @elseif ($alumni->kerja_active !== null)
                                <div class="d-flex me-2 mt-2 status-box">
                                    <div class="circle"></div>
                                    Work
                                </div>
                                @endif
                                @if ($alumni->kuliah_active === null)
                                @elseif ($alumni->kuliah_active !== null)
                                <div class="d-flex me-2 mt-2 status-box">
                                    <div class="circle"></div>
                                    College
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- about -->
                        <div class="about">
                            <div class="fw-bold h3">
                                About Me
                            </div>
                            @if ($alumni->bio === null)
                            <p align="justify">-</p>
                            @else
                            <p align="justify">{{$alumni->bio}}</p>
                            @endif
                        </div>
                        <div class="detail-wrap">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold">NIS</div>
                                    <p>{{$alumni->nis}}</p>
                                </div>
                                <div class="col">
                                    <div class="fw-bold">NISN</div>
                                    <p>{{$alumni->nisn}}</p>
                                </div>
                                <div class="col">
                                    <div class="fw-bold">Angkatan</div>
                                    <p>{{$alumni->angkatan->angkatan}}</p>
                                </div>
                                <div class="col">
                                    <div class="fw-bold">Jurusan</div>
                                    <p>{{$alumni->jurusan->nama}}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="fw-bold">Tempat, Tanggal Lahir</div>
                                    @if ($alumni->tempat_lahir === null && $alumni->tanggal_lahir === null)
                                    <p>-</p>
                                    @elseif ($alumni->tempat_lahir !== null && $alumni->tanggal_lahir !== null)
                                    <p>{{$alumni->tempat_lahir}}, {{\Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d M Y')}}</p>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="fw-bold">Jenis Kelamin</div>
                                    @if ($alumni->gender === null)
                                    <p>-</p>
                                    @elseif ($alumni->gender === 'L')
                                    <p>Laki-Laki</p>
                                    @elseif ($alumni->gender === 'P')
                                    <p>Perempuan</p>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="fw-bold">Agama</div>
                                    @if ($alumni->agama === null)
                                    <p>-</p>
                                    @else
                                    <p>{{$alumni->agama}}</p>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="fw-bold">Email</div>
                                    @if ($alumni->user->email === null)
                                    <p>-</p>
                                    @elseif ($alumni->user->email !== null)
                                    <p>{{$alumni->user->email}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="fw-bold">Nomor Telepon</div>
                                    @if ($alumni->no_telp === null)
                                    <p>-</p>
                                    @elseif ($alumni->no_telp !== null)
                                    <p>{{$alumni->no_telp}}</p>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="fw-bold">Tinggi Badan</div>
                                    @if ($alumni->agama === null)
                                    <p>- cm</p>
                                    @elseif ($alumni->agama !== null)
                                    <p>{{$alumni->tinggi_badan}} cm</p>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="fw-bold">Berat Badan</div>
                                    @if ($alumni->agama === null)
                                    <p>- kg</p>
                                    @elseif ($alumni->agama !== null)
                                    <p>{{$alumni->berat_badan}} kg</p>
                                    @endif
                                </div>
                                <div class="col-3">

                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="fw-bold">
                                    Alamat
                                </div>
                                @if ($alumni->alamat === null)
                                <p>-</p>
                                @elseif ($alumni->alamat !== null)
                                <p>{{$alumni->alamat}}</p>
                                @endif
                            </div>
                            <div class="mt-5">
                                <div class="fw-bold h3">Prestasi</div>
                                @if ($data_prestasi->isEmpty())
                                <i class="bx bxs-badge-check me-2"></i>Belum ada data
                                @else
                                <div class="row ">
                                    @foreach ($data_prestasi as $prestasi)
                                    <div class="card box-prestasi shadow">
                                        <img src="{{('/assets/img/'.$prestasi->foto)}}" class="" alt="foto-prestasi">
                                        <div class="card-body pb-0">
                                            <h5 class="card-title">{{$prestasi->nama}}</h5>
                                            <p class="text-prestasi">{{$prestasi->text}}.</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item" style="font-size: 14px;">Peringkat - {{$prestasi->peringkat}}</li>
                                            <li class="list-group-item" style="font-size: 14px;">Tingkat - {{$prestasi->tingkat}}</li>
                                            <li class="list-group-item" style="font-size: 14px;">Penyelenggara - {{$prestasi->penyelenggara}}</li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="mt-5">
                                <div class="fw-bold h3">Transkrip Nilai</div>
                                <div class="d-flex align-items-center">
                                    @if ($data_nilai->isEmpty())
                                    <i class="bx bx-file me-2"></i> Belum ada data
                                    @else
                                    <a href="#" class="text-decoration-none h5" data-bs-toggle="modal" data-toggle="tooltip" data-placement="bottom" title="Lihat Transkip Nilai" data-bs-target="#nilaiModal">Lihat<i class='bx bx-link-external align-middle'></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="fw-bold h3">
                                    Bekerja
                                    @if ($data_pekerjaan->isEmpty())
                                    @else
                                    <a href="#" class="" data-bs-toggle="modal" data-toggle="tooltip" data-placement="bottom" title="Lihat Riwayat Bekerja"
                                    data-bs-target="#kerjaModal"><i class='bx bx-link-external align-middle'></i></a>
                                    @endif
                                </div>
                                @if ($kerja_active->isEmpty())
                                <i class="bi bi-briefcase-fill me-2"></i> Tidak sedang bekerja
                                @else
                                <i class="bi bi-briefcase-fill me-2"></i>{{$kerja_active[0]->perusahaan}}
                                @endif
                            </div>
                            <div class="mt-5">
                                <div class="fw-bold h3">
                                    Kuliah
                                    @if ($data_pendidikan->isEmpty())
                                    @else
                                    <a href="#" class="" data-bs-toggle="modal" data-toggle="tooltip" data-placement="bottom" title="Lihat Riwayat Pendidikan"
                                    data-bs-target="#kuliahModal"><i class='bx bx-link-external align-middle'></i></a>
                                    @endif
                                </div>
                                @if ($kuliah_active->isEmpty())
                                <i class="bi bi-building me-2"></i> Tidak sedang kuliah
                                @else
                                <i class="bi bi-building me-2"></i>{{$kuliah_active[0]->lembaga}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL BAUT TAMBAH NILAI-->
    <div class="modal fade" id="nilaiModal" tabindex="-1" aria-labelledby="nilaiModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded-20">
                <div class="modal-body">
                    <div class="mb-5">
                        <h4 class="modal-title fw-bold text-center" id="nilaiModalLabel">TRANSKRIP NILAI</h4>
                    </div>
                    <div class="px-3 px-lg-5">
                        <div class="row justify-content-between">
                            <div class="col-5 col-md-5">
                                <pre style="font-family: 'Red Hat Display', sans-serif;">NAMA SEKOLAH              :   SMKN 1 KOTA BEKASI</pre>
                                <pre style="font-family: 'Red Hat Display', sans-serif;">PROGRAM KEAHLIAN   :   {{$alumni->jurusan->nama}}</pre>
                            </div>
                            <div class="col-5 col-md-5">
                                <pre style="font-family: 'Red Hat Display', sans-serif;">NAMA SISWA     :   {{$alumni->nama}}</pre>
                                <pre style="font-family: 'Red Hat Display', sans-serif;">NIS/NISN             :   {{$alumni->nis}}/{{$alumni->nisn}}</pre>
                            </div>
                        </div>
                    </div>
                    <div class="nilai-data">
                        @if ($data_nilai === null)
                            <p class="text-center">Tidak Ada Data</p>
                        @elseif ($data_nilai !== null)
                        <table class="table table-borderless table-rapot my-5">
                            <thead>
                                <tr class="row ps-5">
                                    <th scope="col" class="col-1">#</th>
                                    <th scope="col" class="col-2 me-5">Mata Pelajaran</th>
                                    <th scope="col" class="col">S1</th>
                                    <th scope="col" class="col">S2</th>
                                    <th scope="col" class="col">S3</th>
                                    <th scope="col" class="col">S4</th>
                                    <th scope="col" class="col">S5</th>
                                    <th scope="col" class="col">S6</th>
                                    <th scope="col" class="col">Avg</th>
                                    <th scope="col" class="col-2">Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row ps-5">
                                    <td class="col-1">1</td>
                                    <td class="col-2 me-5">Matematika</td>
                                    @if ($mtk === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$mtk->semester_satu}}</td>
                                    <td class="col">{{$mtk->semester_dua}}</td>
                                    <td class="col">{{$mtk->semester_tiga}}</td>
                                    <td class="col">{{$mtk->semester_empat}}</td>
                                    <td class="col">{{$mtk->semester_lima}}</td>
                                    <td class="col">{{$mtk->semester_enam}}</td>
                                    @endif
                                    <td class="col">{{number_format($mtk_rapot, '2', ',')}}</td>
                                    <td class="col-2">Nilai Rapot</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">2</td>
                                    <td class="col-2 me-5">Bahasa Indonesia</td>
                                    @if ($bindo === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$bindo->semester_satu}}</td>
                                    <td class="col">{{$bindo->semester_dua}}</td>
                                    <td class="col">{{$bindo->semester_tiga}}</td>
                                    <td class="col">{{$bindo->semester_empat}}</td>
                                    <td class="col">{{$bindo->semester_lima}}</td>
                                    <td class="col">{{$bindo->semester_enam}}</td>
                                    @endif
                                    <td class="col">{{number_format($bindo_rapot, '2', ',')}}</td>
                                    <td class="col-2">Nilai Rapot</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">3</td>
                                    <td class="col-2 me-5">Bahasa Inggris</td>
                                    @if ($bing === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$bing->semester_satu}}</td>
                                    <td class="col">{{$bing->semester_dua}}</td>
                                    <td class="col">{{$bing->semester_tiga}}</td>
                                    <td class="col">{{$bing->semester_empat}}</td>
                                    <td class="col">{{$bing->semester_lima}}</td>
                                    <td class="col">{{$bing->semester_enam}}</td>
                                    @endif
                                    <td class="col">{{number_format ($bing_rapot, '2', ',')}}</td>
                                    <td class="col-2">Nilai Rapot</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">4</td>
                                    <td class="col-2 me-5">Pendidikan Kewarganegaraan</td>
                                    @if ($pkn === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$pkn->semester_satu}}</td>
                                    <td class="col">{{$pkn->semester_dua}}</td>
                                    <td class="col">{{$pkn->semester_tiga}}</td>
                                    <td class="col">{{$pkn->semester_empat}}</td>
                                    <td class="col">{{$pkn->semester_lima}}</td>
                                    <td class="col">{{$pkn->semester_enam}}</td>
                                    @endif
                                    <td class="col">{{number_format($pkn_rapot, '2', ',')}}</td>
                                    <td class="col-2">Nilai Rapot</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">5</td>
                                    <td class="col-2 me-5">Pendidikan Agama</td>
                                    @if ($agama === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$agama->semester_satu}}</td>
                                    <td class="col">{{$agama->semester_dua}}</td>
                                    <td class="col">{{$agama->semester_tiga}}</td>
                                    <td class="col">{{$agama->semester_empat}}</td>
                                    <td class="col">{{$agama->semester_lima}}</td>
                                    <td class="col">{{$agama->semester_enam}}</td>
                                    @endif
                                    <td class="col">{{number_format($agama_rapot, '2', ',')}}</td>
                                    <td class="col-2">Nilai Rapot</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">6</td>
                                    <td class="col-2 me-5">Kejuruan</td>
                                    @if ($kejuruan === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$kejuruan->semester_satu}}</td>
                                    <td class="col">{{$kejuruan->semester_dua}}</td>
                                    <td class="col">{{$kejuruan->semester_tiga}}</td>
                                    <td class="col">{{$kejuruan->semester_empat}}</td>
                                    <td class="col">{{$kejuruan->semester_lima}}</td>
                                    <td class="col">{{$kejuruan->semester_enam}}</td>
                                    @endif
                                    <td class="col">{{number_format($kejuruan_rapot, '2', ',')}}</td>
                                    <td class="col-2">Nilai Rapot</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-borderless table-us">
                            <thead>
                                <tr class="row ps-5">
                                    <th scope="col" class="col-1">#</th>
                                    <th scope="col" class="col-2 me-5">Mata Pelajaran</th>
                                    <th scope="col" class="col">Sekolah</th>
                                    <th scope="col" class="col">Praktek</th>
                                    <th scope="col" class="col">Ujian</th>
                                    <th scope="col" class="col">Avg</th>
                                    <th scope="col" class="col-2">Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row ps-5">
                                    <td class="col-1">1</td>
                                    <td class="col-2 me-5">Matematika</td>
                                    @if ($mtk === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$mtk->nilai_sekolah}}</td>
                                    <td class="col">{{$mtk->nilai_praktek}}</td>
                                    <td class="col">{{$mtk->nilai_ujian}}</td>
                                    @endif
                                    <td class="col">{{number_format($mtk_akhir, '2', ',')}}</td>
                                    <td class="col-2">Nilai Akhir</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">2</td>
                                    <td class="col-2 me-5">Bahasa Indonesia</td>
                                    @if ($bindo === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$bindo->nilai_sekolah}}</td>
                                    <td class="col">{{$bindo->nilai_praktek}}</td>
                                    <td class="col">{{$bindo->nilai_ujian}}</td>
                                    @endif
                                    <td class="col">{{number_format($bindo_akhir, '2', ',')}}</td>
                                    <td class="col-2">Nilai Akhir</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">3</td>
                                    <td class="col-2 me-5">Bahasa Inggris</td>
                                    @if ($bing === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$bing->nilai_sekolah}}</td>
                                    <td class="col">{{$bing->nilai_praktek}}</td>
                                    <td class="col">{{$bing->nilai_ujian}}</td>
                                    @endif
                                    <td class="col">{{number_format ($bing_akhir, '2', ',')}}</td>
                                    <td class="col-2">Nilai Akhir</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">4</td>
                                    <td class="col-2 me-5">Pendidikan Kewarganegaraan</td>
                                    @if ($pkn === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$pkn->nilai_sekolah}}</td>
                                    <td class="col">{{$pkn->nilai_praktek}}</td>
                                    <td class="col">{{$pkn->nilai_ujian}}</td>
                                    @endif
                                    <td class="col">{{number_format($pkn_akhir, '2', ',')}}</td>
                                    <td class="col-2">Nilai Akhir</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">5</td>
                                    <td class="col-2 me-5">Pendidikan Agama</td>
                                    @if ($agama === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$agama->nilai_sekolah}}</td>
                                    <td class="col">{{$agama->nilai_praktek}}</td>
                                    <td class="col">{{$agama->nilai_ujian}}</td>
                                    @endif
                                    <td class="col">{{number_format($agama_akhir, '2', ',')}}</td>
                                    <td class="col-2">Nilai Akhir</td>
                                </tr>
                                <tr class="row ps-5">
                                    <td class="col-1">6</td>
                                    <td class="col-2 me-5">Kejuruan</td>
                                    @if ($kejuruan === null)
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    <td class="col">-</td>
                                    @else
                                    <td class="col">{{$kejuruan->nilai_sekolah}}</td>
                                    <td class="col">{{$kejuruan->nilai_praktek}}</td>
                                    <td class="col">{{$kejuruan->nilai_ujian}}</td>
                                    @endif
                                    <td class="col">{{number_format($kejuruan_akhir, '2', ',')}}</td>
                                    <td class="col-2">Nilai Akhir</td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BUAT RIWAYAT KERJA-->
    <div class="modal fade" id="kerjaModal" tabindex="-1" aria-labelledby="kerjaModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded-20">
                <div class="modal-body">
                    <div class="mb-5">
                        <h4 class="modal-title fw-bold text-center" id="kerjaModalLabel">RIWAYAT BEKERJA</h4>
                    </div>
                    <div class="data">
                        @if ($data_pekerjaan === null)
                            <p class="text-center">Tidak Ada Data</p>
                        @elseif ($data_pekerjaan !== null)
                            <table class="table table-borderless table-rapot mb-5">
                                <thead>
                                    <tr class="row ps-5">
                                        <th scope="col" class="col-1">#</th>
                                        <th scope="col" class="col-3">Perusahaan</th>
                                        <th scope="col" class="col">Bidang</th>
                                        <th scope="col" class="col">Jabatan</th>
                                        <th scope="col" class="col">Tahun Mulai</th>
                                        <th scope="col" class="col">Tahun Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pekerjaan as $pekerjaan)
                                    <tr class="row ps-5">
                                        <td class="col-1">{{$id_kerja++}}</td>
                                        <td class="col-3">{{$pekerjaan->perusahaan}}</td>
                                        <td class="col">{{$pekerjaan->bidang}}</td>
                                        <td class="col">{{$pekerjaan->jabatan}}</td>
                                        <td class="col">{{\Carbon\Carbon::parse($pekerjaan->tahun_mulai)->format('Y')}}</td>
                                        <td class="col">{{\Carbon\Carbon::parse($pekerjaan->tahun_selesai)->format('Y')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BUAT RIWAYAT KULIAH-->
    <div class="modal fade" id="kuliahModal" tabindex="-1" aria-labelledby="kuliahModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded-20">
                <div class="modal-body">
                    <div class="mb-5">
                        <h4 class="modal-title fw-bold text-center" id="kuliahModalLabel">RIWAYAT PENDIDIKAN</h4>
                    </div>
                    <div class="data">
                        @if ($data_pendidikan === null)
                            <p class="text-center">Tidak Ada Data</p>
                        @elseif ($data_pendidikan !== null)
                            <table class="table table-borderless table-rapot mb-5">
                                <thead>
                                    <tr class="row ps-5">
                                        <th scope="col" class="col-1">#</th>
                                        <th scope="col" class="col-3">Nama Lembaga</th>
                                        <th scope="col" class="col">Jenis</th>
                                        <th scope="col" class="col">Fakultas</th>
                                        <th scope="col" class="col">Jurusan</th>
                                        <th scope="col" class="col">Gelar</th>
                                        <th scope="col" class="col">Tahun Lulus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pendidikan as $pendidikan)
                                    <tr class="row ps-5">
                                        <td class="col-1">{{$id_kuliah++}}</td>
                                        <td class="col-3">{{$pendidikan->lembaga}}</td>
                                        <td class="col">{{$pendidikan->jenis}}</td>
                                        <td class="col">{{$pendidikan->fakultas}}</td>
                                        <td class="col">{{$pendidikan->prodi}}</td>
                                        <td class="col">{{$pendidikan->gelar}}</td>
                                        <td class="col">{{\Carbon\Carbon::parse($pendidikan->tahun_lulus)->format('Y')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
@include('partials.footer')
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
