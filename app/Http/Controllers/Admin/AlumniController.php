<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumni;
use App\Models\Admin;
use App\Models\AlumniDirekomendasikan;
use App\Models\AlumniMendaftarPelamar;
use App\Models\DataNilai;
use App\Models\DataPrestasi;
use App\Models\DataPendidikan;
use App\Models\DataPekerjaan;
use App\Models\DataWirausaha;
use App\Models\Pelamar;
use App\Models\Rekomendasi;
use App\Models\SeleksiPelamar;
use App\Models\SuratLamaranKerja;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Angkatan;
use App\Models\Mitra;
use App\Models\Rekomend;
use Hamcrest\Core\HasToString;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class AlumniController extends Controller
{
    protected $adminModel;
    protected $alumniModel;
    protected $userModel;
    protected $prestasiModel;
    protected $pendidikanModel;
    protected $pekerjaanModel;
    protected $nilaiModel;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->adminModel = Admin::first();
        $this->alumniModel = Alumni::all();
        $this->userModel = User::all();
        $this->prestasiModel = DataPrestasi::all();
        $this->pendidikanModel = DataPendidikan::all();
        $this->pekerjaanModel = DataPekerjaan::all();
        $this->nilaiModel = DataNilai::all();
    }

    /**
     * Display a Penelusuran of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data_alumni = Alumni::where('angkatan_id', '=', $request->search)->orderBy('jurusan_id', 'ASC');
            $data_angkatan = Angkatan::orderBy('id_angkatan', 'DESC')->get();
            $last_angkatan = Angkatan::where('id_angkatan', '=', $request->search)->first();
        } else {
            $data_alumni = Alumni::orderBy('angkatan_id', 'DESC')->orderBy('jurusan_id', 'ASC');
            $data_angkatan = Angkatan::orderBy('id_angkatan', 'DESC')->get();
            $last_angkatan = Angkatan::orderBy('id_angkatan', 'DESC')->first();
        }

        $data_jurusan = Jurusan::all();
        $data_mitra = Mitra::all();

        // dd($jumlah_alumni);
        $alumni_kerja = Alumni::where('angkatan_id', $last_angkatan->id_angkatan)->whereNotNull('kerja_active')->count();
        $alumni_kuliah = Alumni::where('angkatan_id', $last_angkatan->id_angkatan)->whereNotNull('kuliah_active')->count();
        $alumni_usaha = Alumni::where('angkatan_id', $last_angkatan->id_angkatan)->whereNotNull('usaha_active')->count();
        $alumni_missing = Alumni::where('angkatan_id', $last_angkatan->id_angkatan)->whereNull('kerja_active')->whereNull('kuliah_active')->whereNull('usaha_active')->count();

        foreach ($data_jurusan as $jurusan) {
            $data['label'][] = $jurusan->akronim;
            $data['kerja'][] = (int) $alumni_kerja;
            $data['kuliah'][] = (int) $alumni_kuliah;
            $data['usaha'][] = (int) $alumni_usaha;
            $data['missing'][] = (int) $alumni_missing;
        }

        $data['chart_data'] = json_encode($data);


        return view('admin.alumni.penelusuran', [
            'active' => 'alumni',
            'data_alumni' => $data_alumni,
            'data_mitra' => $data_mitra,
            'data_jurusan' => $data_jurusan,
            'data_angkatan' => $data_angkatan,
            'last_angkatan' => $last_angkatan,
            'alumni_kerja' => $alumni_kerja,
            'alumni_kuliah' => $alumni_kuliah,
            'alumni_usaha' => $alumni_usaha,
            'alumni_missing' => $alumni_missing,
            // 'id_ang' => $angkatan_alumni,
        ], $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $alumni = Alumni::orderBy('nis', 'ASC')->orderBy('angkatan_id', 'DESC')->orderBy('nama', 'ASC')->get();

        return view('admin.alumni.daftar', [
            'active' => 'alumni',
            'admin' => $this->adminModel,
            'data_alumni' => $alumni,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = DB::table('jurusan')->get();
        $angkatan = DB::table('angkatan')->get();

        // dd($jurusan[0]->id);
        return view('admin.alumni.add', [
            'active' => 'alumni',
            'admin' => $this->adminModel,
            'jurusan' => $jurusan,
            'angkatan' => $angkatan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->nisn);
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|min:9|unique:alumni,nis',
            'nisn' => 'required|min:10|unique:alumni,nisn',
            'jurusan' => 'required|size:8',
            'angkatan' => 'required|size:8',
        ]);

        $alumni = new Alumni;
        $id_alumni = DB::select("SELECT newidalumni() AS id_alumni");
        $id_alumni = $id_alumni[0];
        $id_alumni = $id_alumni->id_alumni;

        $user = new User;
        $id_user = DB::select("SELECT newiduser() AS id_user");
        $id_user = $id_user[0];
        $id_user = $id_user->id_user;


        // ambil input
        $jurusan_id = $request->jurusan;
        $angkatan_id = $request->angkatan;
        $nama = strtoupper($request->nama);
        $nis = $request->nis;
        $nisn = $request->nisn;
        $password = Hash::make($request->nis);
        $created_at = \Carbon\Carbon::now('Asia/Jakarta');
        $updated_at = \Carbon\Carbon::now('Asia/Jakarta');

        // jalankan method add_newalumni
        $alumni->add_newalumni($jurusan_id, $angkatan_id, $nama, $nis, $nisn, $password, $created_at, $updated_at);

        return redirect('/ad/al/list')->with('success', 'Alumni berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         * Decrypt id_alumni
         */
        $decrypt = decrypt($id);

        /**
         * get data alumni dari model berdasarkan id_alumni
         */
        $data_alumni = $this->alumniModel->where('id_alumni', $decrypt)->first();
        // $alumni = $data_alumni[0];

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

        // dd($data_nilai);

        /**
         * Memanggil Method dari Model DataNilai untuk menghitung Rata2 nilai rapot per-mapel
         */
        $nilai_model = new DataNilai();

        $mtk_rapot= $nilai_model->mtk_rapot($decrypt);
        $bing_rapot= $nilai_model->bing_rapot($decrypt);
        $bindo_rapot= $nilai_model->bindo_rapot($decrypt);
        $pkn_rapot= $nilai_model->pkn_rapot($decrypt);
        $agama_rapot= $nilai_model->agama_rapot($decrypt);
        $kejuruan_rapot= $nilai_model->kejuruan_rapot($decrypt);

        $mtk_akhir= $nilai_model->mtk_akhir($decrypt);
        $bing_akhir= $nilai_model->bing_akhir($decrypt);
        $bindo_akhir= $nilai_model->bindo_akhir($decrypt);
        $pkn_akhir= $nilai_model->pkn_akhir($decrypt);
        $agama_akhir= $nilai_model->agama_akhir($decrypt);
        $kejuruan_akhir= $nilai_model->kejuruan_akhir($decrypt);

        /**
         * get dan count data pekerjaan dari model berdasarkan id_alumni
         */
        $data_pekerjaan = $this->pekerjaanModel->where('alumni_id', $decrypt);
        $kerja_active = $this->pekerjaanModel->where('alumni_id', $decrypt)->where('status', 'active')->first();

        /**
         * get dan count data pendidikan dari model berdasarkan id_alumni
         */
        $data_pendidikan = $this->pendidikanModel->where('alumni_id', $decrypt);
        $kuliah_active = $this->pendidikanModel->where('alumni_id', $decrypt)->where('status', 'active')->first();

        // dd($data_pekerjaan);

        return view('admin.alumni.detail', [
            'active' => 'alumni',
            'admin' => $this->adminModel,
            'alumni' => $data_alumni,
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
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt = decrypt($id);
        $alumni = $this->alumniModel->find($decrypt);

        $jurusan = DB::table('jurusan')->get();
        $angkatan = DB::table('angkatan')->get();

        // dd($alumni);
        return view('admin.alumni.edit', [
            'active' => 'alumni',
            'admin' => $this->adminModel,
            'alumni' => $alumni,
            'jurusan' => $jurusan,
            'angkatan' => $angkatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $decrypt = decrypt($id);
        $encrypt = encrypt($decrypt);

        $request->validate([
            'nama' => 'required',
            'nis' => 'required|min:9|unique:alumni,nis',
            'nisn' => 'required|min:10|unique:alumni,nisn',
            'jurusan' => 'required|size:8',
            'angkatan' => 'required|size:8',
        ]);

        $data_alumni = Alumni::findOrFail($decrypt);
        $id_user = $data_alumni->user_id;

        $data_user = User::findOrFail($id_user);

        $oldPassword = $request->oldPassword;
        $newPassword = $request->password;

        if ($newPassword) {
            $password = bcrypt($newPassword);
        } else {
            $password = $oldPassword;
        }

        $updated_at = \Carbon\Carbon::now();

                // dd($id_user, $data_user);
                /**
         * Insert to field users
         */
        $data_user->update([
            'id' => $id_user,
            'password' => bcrypt($password),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        /**
         * Insert to field alumni
         */
        $data_alumni->update([
            'id_alumni' => $decrypt,
            'jurusan_id' => $request->jurusan,
            'angkatan_id' => $request->angkatan,
            'nama' => strtoupper($request->nama),
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/ad/al/detail/' . $encrypt)->with('success', 'Alumni berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_user = $this->alumniModel->where('id_alumni', $id)->first();
        $id_user = $id_user->user_id;

        $alumni = Alumni::findOrFail($id)->delete();
        $user = User::findOrFail($id_user)->delete();
        $nilai = DataNilai::findOrFail($id)->delete();
        $prestasi = DataPrestasi::findOrFail($id)->delete();
        $pendidikan = DataPendidikan::findOrFail($id)->delete();
        $pekerjaan = DataPekerjaan::findOrFail($id)->delete();
        $wirausaha = DataWirausaha::findOrFail($id)->delete();
        $alumni_direkomendasikan = AlumniDirekomendasikan::findOrFail($id)->delete();
        $alumni_pelamar = AlumniMendaftarPelamar::findOrFail($id)->delete();
        $pelamar = Pelamar::findOrFail($id)->delete();
        $seleksi_pelamar = SeleksiPelamar::findOrFail($id)->delete();
        $surat_lamaran = SuratLamaranKerja::findOrFail($id)->delete();
        $rekomendasi = Rekomend::findOrFail($id)->delete();
        $rekomendasi = Rekomend::findOrFail($id)->delete();
        $rekomendasi = Rekomend::findOrFail($id)->delete();

        return redirect('/ad/al/list');
    }
}