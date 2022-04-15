<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Admin;
use \App\Models\Alumni;
use \App\Models\Mitra;
use \App\Models\User;
use App\Models\Tahap;
use App\Models\Galeri;
use App\Models\AlumniDirekomendasikan;
use App\Models\AlumniMendaftarPelamar;
use App\Models\DataNilai;
use App\Models\DataPrestasi;
use App\Models\DataPendidikan;
use App\Models\DataPekerjaan;
use App\Models\DataWirausaha;
use App\Models\Informasi;
use App\Models\LowonganKerja;
use App\Models\Pelamar;
use App\Models\Rekomendasi;
use App\Models\Requirement;
use App\Models\SeleksiPelamar;
use App\Models\SuratLamaranKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;

class PagesController extends Controller
{
    protected $adminModel;
    protected $alumniModel;
    protected $userModel;
    protected $prestasiModel;
    protected $pendidikanModel;
    protected $pekerjaanModel;
    protected $wirausahaModel;
    protected $nilaiModel;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->adminModel = Admin::first();
        $this->alumniModel = new Alumni;
        $this->mitraModel = Mitra::all();
        $this->userModel = User::all();
        $this->prestasiModel = DataPrestasi::all();
        $this->pendidikanModel = new DataPendidikan;
        $this->pekerjaanModel = new DataPekerjaan;
        $this->wirausahaModel = new DataWirausaha;
        $this->nilaiModel = DataNilai::all();
    }
    /**
     * Halaman Landing Pages
     */
    public function index()
    {
        $news = Informasi::all();

        $data = [
            'active' => 'home',
            'news' => $news,
        ];
        return view('pages.landingpage', $data);
    }

    /**
     * Halaman Profil BKK
     */
    public function about()
    {
        return view('pages.profile', [
            'active' => 'about',
        ]);
    }

    /**
     * Halaman Alumni dan Search Alumni
     */
    public function alumni(Request $request)
    {
        if ($request->has('q')) {
            $data_alumni = Alumni::where('nama', 'LIKE', '%' . $request->q . '%')->get();
        } else {
            // $data_alumni = Alumni::orderBy('nis', 'ASC')->get();
            $data_alumni = $this->alumniModel->orderBy('nis', 'ASC')->orderBy('nama', 'ASC')->orderBy('angkatan_id', 'DESC')->get();
        }

        $id_alumni = $this->alumniModel->get('id_alumni');

        /**
         * get dan count data prestasi dari model berdasarkan id_alumni
         */
        $data_prestasi = $this->prestasiModel;

        /**
         * get dan count data nilai dari model berdasarkan id_alumni
         */
        $data_nilai = $this->nilaiModel;

        /**
         * get dan count data nilai dari model berdasarkan id_alumni
         */
        $data_pekerjaan = $this->pekerjaanModel;
        foreach ($id_alumni as $id) {
            $kerja_active = $this->pekerjaanModel->where('alumni_id', $id)->where('status', 'active');
            // dd($id, $id, $kerja_active);
        }

        /**
         * get dan count data nilai dari model berdasarkan id_alumni
         */
        $data_pendidikan = $this->pendidikanModel;
        $kuliah_active = $this->pendidikanModel->where('status', 'active');

        /**
         * get dan count data nilai dari model berdasarkan id_alumni
         */
        $data_wirausaha = $this->wirausahaModel;

        $data = [
            'active' => 'alumni',
            'data_alumni' => $data_alumni,
            'admin' => $this->adminModel,
            'data_prestasi' => $data_prestasi,
            'data_nilai' => $data_nilai,
            'data_pekerjaan' => $data_pekerjaan,
            'kerja_active' => $kerja_active,
            'data_pendidikan' => $data_pendidikan,
            'kuliah_active' => $kuliah_active,
            'data_wirausaha' => $data_wirausaha,
        ];

        return view('pages.alumni.main', $data);
    }

    /**
     * Halaman Detail Alumni
     */
    public function alumniShow($id)
    {
        /**
         * Decrypt id_alumni
         */
        $decrypt = decrypt($id);

        /**
         * get data alumni dari model berdasarkan id_alumni
         */
        $data_alumni = Alumni::where('id_alumni', $decrypt)->get();
        $alumni = $data_alumni[0];

        /**
         * get dan count data prestasi dari model berdasarkan id_alumni
         */
        $data_prestasi = $this->prestasiModel->where('alumni_id', $decrypt);
        $count_dataPrestasi = $data_prestasi->count();

        /**
         * get dan count data nilai dari model berdasarkan id_alumni
         */
        $data_nilai = $this->nilaiModel->where('alumni_id', $decrypt);
        $count_dataNilai = $data_nilai->count();

        $mtk = $this->nilaiModel->where('alumni_id', $decrypt)->where('nama', 'Matematika')->first();
        $bing = $this->nilaiModel->where('alumni_id', $decrypt)->where('nama', 'Bahasa Inggris')->first();
        $bindo = $this->nilaiModel->where('alumni_id', $decrypt)->where('nama', 'Bahasa Indonesia')->first();
        $pkn = $this->nilaiModel->where('alumni_id', $decrypt)->where('nama', 'Pendidikan Kewarganegaraan')->first();
        $agama = $this->nilaiModel->where('alumni_id', $decrypt)->where('nama', 'Pendidikan Agama')->first();
        $kejuruan = $this->nilaiModel->where('alumni_id', $decrypt)->where('nama', 'Kejuruan')->first();


        /**
         * Memanggil Method dari Model DataNilai untuk menghitung Rata2 nilai rapot per-mapel
         */
        $nilai_model = new DataNilai();

        $mtk_rapot = $nilai_model->mtk_rapot($decrypt);
        $bing_rapot = $nilai_model->bing_rapot($decrypt);
        $bindo_rapot = $nilai_model->bindo_rapot($decrypt);
        $pkn_rapot = $nilai_model->pkn_rapot($decrypt);
        $agama_rapot = $nilai_model->agama_rapot($decrypt);
        $kejuruan_rapot = $nilai_model->kejuruan_rapot($decrypt);

        $mtk_akhir = $nilai_model->mtk_akhir($decrypt);
        $bing_akhir = $nilai_model->bing_akhir($decrypt);
        $bindo_akhir = $nilai_model->bindo_akhir($decrypt);
        $pkn_akhir = $nilai_model->pkn_akhir($decrypt);
        $agama_akhir = $nilai_model->agama_akhir($decrypt);
        $kejuruan_akhir = $nilai_model->kejuruan_akhir($decrypt);

        /**
         * get dan count data pekerjaan dari model berdasarkan id_alumni
         */
        $data_pekerjaan = $this->pekerjaanModel->where('alumni_id', $decrypt)->get();
        $kerja_active = $data_pekerjaan->where('id', $alumni->kerja_active);
        // $kerja_active = $kerja_active[0];

        // dd($data_pekerjaan);

        /**
         * get dan count data pendidikan dari model berdasarkan id_alumni
         */
        $data_pendidikan = $this->pendidikanModel->where('alumni_id', $decrypt)->get();
        $kuliah_active = $data_pendidikan->where('id', $alumni->kuliah_active);
        // $kuliah_active = $kuliah_active[0];

        // dd($kerja_active);

        $data = [
            'active' => 'alumni',
            'admin' => $this->adminModel,
            'id_kerja' => 1,
            'id_kuliah' => 1,
            'alumni' => $alumni,
            'data_prestasi' => $data_prestasi,
            'count_prestasi' => $count_dataPrestasi,
            'data_nilai' => $data_nilai,
            'mtk' => $mtk,
            'bing' => $bing,
            'bindo' => $bindo,
            'pkn' => $pkn,
            'agama' => $agama,
            'kejuruan' => $kejuruan,
            'count_nilai' => $count_dataNilai,
            'mtk_rapot' => $mtk_rapot,
            'mtk_akhir' => $mtk_akhir,
            'bing_rapot' => $bing_rapot,
            'bing_akhir' => $bing_akhir,
            'bindo_rapot' => $bindo_rapot,
            'bindo_akhir' => $bindo_akhir,
            'pkn_rapot' => $pkn_rapot,
            'pkn_akhir' => $pkn_akhir,
            'agama_rapot' => $agama_rapot,
            'agama_akhir' => $agama_akhir,
            'kejuruan_rapot' => $kejuruan_rapot,
            'kejuruan_akhir' => $kejuruan_akhir,
            'data_pekerjaan' => $data_pekerjaan,
            'kerja_active' => $kerja_active,
            'data_pendidikan' => $data_pendidikan,
            'kuliah_active' => $kuliah_active,
        ];

        return view('pages.alumni.detail', $data);
    }

    /**
     * Halaman Loker dan Search Loker
     */
    public function jobvacancy()
    {
        $loker = LowonganKerja::all();
        $data = [
            'active' => 'vacancy',
            'loker' => $loker,
        ];

        return view('pages.loker.main', $data);
    }

    /**
     * Halaman Detail Loker dan Search Detail Loker
     */
    public function detailvacany($id)
    {
        // $idloker = decrypt($id);
        $loker = LowonganKerja::where('slug', $id)->first();
        $id_loker = $loker->id_lowongankerja;
        // dd($id_loker);
        if ($loker->mitra->foto == 'default-company.png') {
            $urlImg = '/assets/img/imp/';
        } else {
            $urlImg = '/assets/img/';
        }
        // dd($urlImg);
        $requirement = Requirement::where('lowongankerja_id', $id_loker)->get();
        $tahap = Tahap::where('lowongankerja_id', $id_loker)->get();
        $galeri = Galeri::where('lowongankerja_id', $id_loker)->get();

        $data = [
            'active' => 'vacancy',
            'loker' => $loker,
            'urlImg' => $urlImg,
            'requirement' => $requirement,
            'tahap' => $tahap,
            'galeri' => $galeri,
        ];

        return view('pages.loker.detail', $data);
    }

    /**
     * Halaman Mitra dan Search Mitra
     */
    public function mitra(Request $request)
    {
        if ($request->has('q')) {
            $data_mitra = Mitra::where('nama', 'LIKE', '%' . $request->q . '%')->get();
        } else {
            // $data_mitra = Alumni::orderBy('nis', 'ASC')->get();
            $data_mitra = Mitra::orderBy('nama', 'ASC')->orderBy('created_at', 'DESC')->get();
        }
        // $mitra = Mitra::all();

        $data = [
            'active' => 'mitra',
            'data_mitra' => $data_mitra,
        ];

        return view('pages.mitra.main', $data);
    }

    /**
     * Halaman Detail Mitra
     */
    public function mitradetail($id)
    {
        $mitra = Mitra::where('id_mitra', $id)->first();
        if ($mitra->foto == 'default-company.png') {
            $urlImg = '/assets/img/imp/';
        } else {
            $urlImg = '/assets/img/';
        }

        $data = [
            'active' => 'mitra',
            'mitra' => $mitra,
            'urlImg' => $urlImg,
        ];

        return view('pages.mitra.detail', $data);
    }

    /**
     * Halaman Information dan Search Information
     */
    public function information(Request $request)
    {
        if ($request->has('q')) {
            $data_informasi = Informasi::where('title', 'LIKE', '%' . $request->q . '%')->get();
        } else {
            // $data_informasi = Alumni::orderBy('nis', 'ASC')->get();
            $data_informasi = Informasi::orderBy('title', 'ASC')->orderBy('created_at', 'DESC')->get();
        }
        // $news = Informasi::all();
        $data = [
            'active' => 'information',
            'data_informasi' => $data_informasi,
        ];
        return view('pages.informasi.main', $data);
    }

    /**
     * Halaman Detail Information
     */
    public function informationdetail($id)
    {
        $new = Informasi::where('slug', $id)->first();
        $news = Informasi::all()->except($new->id_informasi);
        // dd($news);
        $data = [
            'active' => 'information',
            'new' => $new,
            'news' => $news,
        ];
        return view('pages.informasi.detail', $data);
    }
}