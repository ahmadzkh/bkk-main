<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongankerja;
use App\Models\Tahap;
use App\Models\Galeri;
use App\Models\Mitra;
use App\Models\Alumni;
use App\Models\Requirement;
use App\Models\Jurusan;
use App\Models\Kantor;
use App\Models\Rekomend;
use App\Models\Pelamar;
use App\Models\SeleksiPelamar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LokerController extends Controller
{
    /**
    * menampilkan halman utama
    *
    *
    * @return void
    */
    public function main(Request $request)
    {
        $user_id = auth()->user()->id;
        $mitra = Mitra::where('user_id', $user_id)->first();
        // $loker = Lowongankerja::where('mitra_id', $mitra->id_mitra)->get();
        $search = $request->search;
        if ($search) {
            $loker = Lowongankerja::where([['mitra_id', $mitra->id_mitra],['title','like',"%".$search."%"]])
                ->orWhere([['mitra_id', $mitra->id_mitra],['posisi','like',"%".$search."%"]])
                ->orWhere([['mitra_id', $mitra->id_mitra],['kategori','like',"%".$search."%"]])
                ->paginate(1);
            $searchData = $request->search;
        }else{
            $loker = Lowongankerja::where('mitra_id', $mitra->id_mitra)
                ->paginate(10);
            $searchData = '';
        }

        if ($loker->isEmpty()) {
            $requirement = null;
            $age = null;
        }else{
            foreach ($loker as $key => $lkr) {
                $requirement[$key++] = Requirement::where('lowongankerja_id', $lkr->id_lowongankerja)->get();
                $age[$key++] = ['id' => $lkr->id_lowongankerja,'date' => Carbon::parse($lkr->created_at)->diffForHumans()];
            }
        }

        if ($mitra->foto == 'default-company.png') {
            $urlImg = '/assets/img/imp/';
        }else{
            $urlImg = '/assets/img/mitra/';
        }

        $data = [
            'active' => 'loker',
            'loker' => $loker,
            'requirement' => $requirement,
            'urlImg' => $urlImg,
            'ages' => $age,
            'searchData' => $searchData,
        ];

        return view('mitra.loker.main', $data);
    }

    /**
     * menampilkan halman detail
     *
     *
     * @return void
     */
    public function detail($id)
    {
        $user_id = auth()->user()->id;
        $mitra = Mitra::where('user_id', $user_id)->first();
        $loker = Lowongankerja::where([['mitra_id', $mitra->id_mitra],['id_lowongankerja', $id]])->first();

        if ($loker == null) {
            return redirect('/mt/lk/main')->with('error', 'Data tidak dapat diakses!');
        }

        $requirement = Requirement::where('lowongankerja_id', $loker->id_lowongankerja)->get();
        $tahap = Tahap::where('lowongankerja_id', $loker->id_lowongankerja)->get();
        $galeri = Galeri::where('lowongankerja_id', $loker->id_lowongankerja)->get();

        $data = [
            'active' => 'loker',
            'loker' => $loker,
            'requirement' => $requirement,
            'tahap' => $tahap,
            'galeri' => $galeri,
        ];

        return view('mitra.loker.detail', $data);
    }

    /**
    * menampilkan halman tambah
    *
    *
    * @return void
    */
    public function tambah()
    {
        $user_id = auth()->user()->id;
        $mitra = Mitra::where('user_id', $user_id)->first();

        $jurusan = Jurusan::all();
        $lokasi_kerja = Kantor::where('mitra_id', $mitra->id_mitra)->get();

        if ($mitra->foto == 'default-company.png') {
            $urlImg = '/assets/img/imp/';
        }else{
            $urlImg = '/assets/img/';
        }

        $data = [
            'active' => 'loker',
            'jurusan' => $jurusan,
            'lokasi_kerja' => $lokasi_kerja,
            'mitra' => $mitra,
            'urlImg' => $urlImg,
        ];

        return view('mitra.loker.tambah', $data);
    }

    /**
    * store
    *
    * @param  mixed $request
    * @return void
    */
    public function store(Request $request)
    {
        // MEMVALIDASI
        $this->validate($request, [
            'title'             => 'required|min:5',
            'kategori'          => 'required',
            'jurusan'           => 'required',
            'jenis_pekerjaan'   => 'required',
            'posisi'            => 'required',
            'kuota'             => 'required|numeric',
            'lokasi_kerja'      => 'required',
            'deskripsi'         => 'required',
            'gaji'              => 'required|numeric',
            'kedaluwarsa'       => 'required|date',
            'req'               => 'nullable|min:5',
            'banner'            => 'nullable|image|mimes:png,jpg,jpeg|max:80000',
            'namasec.*'         => 'required',
            'tahapsec.*'        => 'required',
            'datesec.*'         => 'required',
            // 'fotos'             => 'nullable|image|mimes:png,jpg,jpeg|max:80000',
        ],[
            // MEMBUAT MESSAGE VALIDASI SENDRI
            'req.min'           => 'Field Requirement must over 7 characters!',
        ]);

        $user_id = auth()->user()->id;
        $mitra = Mitra::where('user_id', $user_id)->first();
        // MENGAMBIL KODE LOKER BARU
        $kodeloker = DB::select('SELECT newidloker() AS kodeloker');
        $kodeloker = $kodeloker[0]->kodeloker;
        $kodetahap = DB::select('SELECT newidtahap() AS kodetahap');
        $kodetahap = $kodetahap[0]->kodetahap;

        // MEMBUAT LOKER
        // MENGAMBIL WAKTU
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        // JIKA WAKTU SEKARANG MELIBHI KEDALUWARSA
        if ($request->kedaluwarsa >= $dateNow){
            $status = 1;
        }else{
            $status = 0;
        }

        // SAVING BANNER
        $banner = $request->file('banner');
        // JIKA BANNER ADA
        if ($banner !== null) {
            // BUAT NAMA BARU
            $nameBanner = pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFileBanner = $nameBanner . "-" . time() . Str::random(5) . "." .$banner->getClientOriginalExtension();
            // PINDAHIN
            $banner->move(public_path('/assets/img/mitra'), $fullFileBanner);
        }else{
            $fullFileBanner = null;
        }

        // BUAT LOKER BARU
        $loker = Lowongankerja::create([
            'id_lowongankerja'  => $kodeloker,
            'mitra_id'          => $mitra->id_mitra,
            'jurusan_id'        => $request->jurusan,
            'kantor_id'         => $request->lokasi_kerja,
            'title'             => $request->title,
            'kategori'          => $request->kategori,
            'kedaluwarsa'       => $request->kedaluwarsa,
            'posisi'            => $request->posisi,
            'kuota'             => $request->kuota,
            'gaji'              => $request->gaji,
            'deskripsi'         => $request->deskripsi,
            'jenis_pekerjaan'   => $request->jenis_pekerjaan,
            'banner'            => $fullFileBanner,
            'status'            => $status,
        ]);

        // SAVING IMAGE AND MAKING NAME
        $fotos = $request->file('fotos');
        // JIKA FOTO-FOTO ADA
        if ($fotos !== null) {
            foreach ($fotos as $foto) {
                // BUAT NAMA BARU
                $fileName = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
                $fullFileName = $fileName . "-" . time() . Str::random(5) . "." .$foto->getClientOriginalExtension();

                // TAMBAH KE GALERI
                $galeri = Galeri::create([
                    'lowongankerja_id'  => $kodeloker,
                    'foto'              => $fullFileName,
                    'keterangan'        => 'Membuat Foto'
                ]);
                // PINDAHIN GAMBARNYA
                $foto->move(public_path('/assets/img/galeri'), $fullFileName);
            }
        }
        $galeri = true;

        // SAVING PERSYARATAN
        $req = $request->req;
        foreach ($req as $data) {
            // jika req ada
            if ($data !== null) {
                $requirement = Requirement::create([
                    'lowongankerja_id'  => $kodeloker,
                    'text'              => $data,
                ]);
            }
            $requirement = true;
        }

        // SAVING TAHAPAN
        $tahap = $request->tahapsec;
        $nama = $request->namasec;
        $date = $request->datesec;

        // MEMBUAT KODE TAHAP BARU
        $ambilTahap = substr($kodetahap, 3);
        $ambilTahap = str_pad($ambilTahap, 5, 0, STR_PAD_LEFT);
        foreach($tahap as $i => $val) {
            $ambilTahap++;
            $kodetahapbaru = 'THP' . str_pad($ambilTahap - 1, 5, 0, STR_PAD_LEFT);

            // JIKA DATA ADA
            if ($val !== null && $nama[$i] !== null && $date[$i] !== null) {
                $tahapan = Tahap::create([
                    'id_tahap'          => $kodetahapbaru,
                    'lowongankerja_id'  => $kodeloker,
                    'tahap_ke'          => $val,
                    'nama'              => $nama[$i],
                    'tanggal_seleksi'   => $date[$i],
                    'keterangan'        => 'Ini adalah tahapan ke '. $val .' yang akan dilakukan pada '. $date[$i],
                    'status'            => '0',
                ]);
            }
            $tahapan = true;
            $kodetahap++;
        }

        if($loker && $galeri && $requirement && $tahapan){
            //redirect dengan pesan sukses
            return redirect()->route('mitra.main.loker')->with(['success' => 'Data Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
    * menampilkan halman ubah
    *
    *
    * @return void
    */
    public function ubah($id)
    {
        $user_id = auth()->user()->id;
        $mitra = Mitra::where('user_id', $user_id)->first();
        $loker = Lowongankerja::where([['mitra_id', $mitra->id_mitra],['id_lowongankerja', $id]])->first();

        if ($loker == null) {
            return redirect('/mt/lk/main')->with('error', 'Data tidak dapat diakses!');
        }

        $jurusan = Jurusan::all();
        $kantor = Kantor::where('mitra_id', $mitra->id_mitra)->get();
        $requirement = Requirement::where('lowongankerja_id', $id)->get();
        $tahap = Tahap::where('lowongankerja_id', $id)->get();
        $galeri = Galeri::where('lowongankerja_id', $id)->get();

        if ($loker->mitra->foto == 'default-company.png') {
            $urlImg = '/assets/img/imp/';
        }else{
            $urlImg = '/assets/img/';
        }

        $data = [
            'active' => 'loker',
            'jurusan' => $jurusan,
            'kantor' => $kantor,
            'loker' => $loker,
            'reqs' => $requirement,
            'tahap' => $tahap,
            'galeri' => $galeri,
            'urlImg' => $urlImg,
        ];

        return view('mitra.loker.ubah', $data);
    }

    /**
    * store
    *
    * @param  mixed $request
    * @return void
    */
    public function ubahStore(Request $request)
    {
        // MEMVALIDASI
        $this->validate($request, [
            'title'             => 'required|min:5',
            'kategori'          => 'required',
            'jurusan'           => 'required',
            'jenis_pekerjaan'   => 'required',
            'posisi'            => 'required',
            'kuota'             => 'required|numeric',
            'kantor'            => 'required',
            'deskripsi'         => 'required',
            'gaji'              => 'required|numeric',
            'kedaluwarsa'       => 'required|date',
            'req'               => 'nullable',
            'banner'            => 'image|max:80000',
            'fotos.*'             => 'image|max:80000',
            'namasec.*'           => 'required',
            'tahapsec.*'          => 'required',
            'datesec.*'           => 'required',
        ],[
            'req.min'           => 'Field Requirement must over 7 characters!',
        ]);


        // MENDAPATKAN DATA LOKER
        $loker = Lowongankerja::findOrFail($request->loker_id);

        // MENGAMBIL KODE TAHAP BARU
        $kodetahap = DB::select('SELECT newidtahap() AS kodetahap');
        $kodetahap = $kodetahap[0]->kodetahap;

        // MEMBUAT LOKER
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        // JIKA SEKARANG KURANG DARI KEDALUWARSA
        if ($request->kedaluwarsa >= $dateNow){
            $status = '1';
        }else{
            $status = '0';
        }

        // SAVING BANNER
        $banner = $request->file('banner');
        // JIKA BANNER ADA
        if ($banner !== null) {
            // BUAT NAMA BARU
            $nameBanner = pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFileBanner = $nameBanner . "-" . time() . Str::random(5) . "." .$banner->getClientOriginalExtension();
            // PINDAHIN
            $banner->move(public_path('/assets/img/mitra'), $fullFileBanner);

            $link = str_replace('\\', '/', public_path('assets/img/mitra/'));
            if ($loker->banner !== 'banner-default.jpg') {
            // MOVE IF GAMBAR TIDAK SAMA DENGAN DEFAULT
                unlink($link. $loker->banner);
            }
        }else{
            $fullFileBanner = $loker->banner;
        }

        // LOKER UPDATE
        $loker->update([
            'jurusan_id'        => $request->jurusan,
            'kantor_id'         => $request->kantor,
            'title'             => $request->title,
            'kategori'          => $request->kategori,
            'kedaluwarsa'       => $request->kedaluwarsa,
            'posisi'            => $request->posisi,
            'kuota'             => $request->kuota,
            'gaji'              => $request->gaji,
            'deskripsi'         => $request->deskripsi,
            'jenis_pekerjaan'   => $request->jenis_pekerjaan,
            'banner'            => $fullFileBanner,
            'status'            => $status,
        ]);


        // SAVING IMAGE AND MAKING NAME
        $fotos = $request->file('fotos');
        $old_foto = Galeri::where('lowongankerja_id', '=', $loker->id_lowongankerja)->get()->toArray();
        $old_fotos = $request->old_fotos;
        $id_fotos = $request->id_fotos;

        // MENGEDIT FOTO
        foreach ($old_foto as $key => $oldfoto) {
            // JIKA FOTO LAMA ADA
            if ($old_fotos[$key] !== null) {
                // JIKA TIDAK SAMA DENGAN FOTO DI DATABASE
                if ($old_fotos[$key] !== $oldfoto['foto']) {
                    // GET NEW NAME IMAGE
                    $fileName = pathinfo($old_fotos[$key]->getClientOriginalName(), PATHINFO_FILENAME);
                    $fullFileName = $fileName . "-" . time() . Str::random(5) . "." . $old_fotos[$key]->getClientOriginalExtension();

                    // SAVE IMAGE
                    Galeri::findOrFail($oldfoto['id_galeri'])->update([
                        'foto'              => $fullFileName,
                        'keterangan'        => 'Mengubah Foto'
                    ]);
                    // DELETE OLD IMAGE
                    $link = str_replace('\\', '/', public_path('assets/img/galeri/'));
                    unlink($link. $oldfoto['foto']);
                    // MOVE IMAGE TO DIR
                    $old_fotos[$key]->move(public_path('/assets/img/galeri'), $fullFileName);
                }
            }else{
                // GET IMAGE AND DELETe
                Galeri::findOrFail($id_fotos[$key])->delete();
                $link = str_replace('\\', '/', public_path('assets/img/galeri/'));
                // DELETE FROM LOCAL STORAGE
                unlink($link. $oldfoto['foto']);
            }
        }

        // MENSAVE FOTO
        // JIKA FOTO ADA
        if ($fotos) {
            foreach ($fotos as $foto) {
                // BUAT NAMA BARU
                $fileName = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
                $fullFileName = $fileName . "-" . time() . Str::random(5) . "." . $foto->getClientOriginalExtension();

                // CREATE IMAGE
                $galeriNew = Galeri::create([
                    'lowongankerja_id'  => $loker->id_lowongankerja,
                    'foto'              => $fullFileName,
                    'keterangan'        => 'Membuat Foto'
                ]);

                // MOVE IMAGE TO DIR
                $foto->move(public_path('/assets/img/galeri'), $fullFileName);
            }
        }
        $galeriNew = 'Tidak Bertambah';

        // SAVING PERSYARATAN
        $req = $request->req;
        $id_req = $request->id_req;
        $old_req = Requirement::where('lowongankerja_id', $loker->id_lowongankerja)->get()->toArray();

        // dd($req, $id);
        foreach ($req as $key => $data) {
            // UPDATE
            if ($data && isset($id_req[$key]) && $old_req[$key]['text'] !== $data && $old_req[$key]['id_persyaratan'] == intval($id_req[$key])) {
                Requirement::findOrFail($old_req[$key]['id_persyaratan'])->update([
                    'text'              => $data,
                ]);
            }elseif ($data && !isset($id_req[$key])) {
                // CREATE
                $requirement = Requirement::create([
                    'lowongankerja_id'  => $loker->id_lowongankerja,
                    'text'              => $data,
                ]);
            }elseif ($data == null && isset($id_req[$key])){
                // DELETE
                Requirement::findOrFail($old_req[$key]['id_persyaratan'])->delete();
            }
            $requirementOld = 'Tidak Berubah';
        }

        // SAVING TAHAPAN
        $tahap = $request->tahapsec;
        $nama = $request->namasec;
        $date = $request->datesec;
        $id_tahap = $request->id_tahap;
        $old_tahap = Tahap::where('lowongankerja_id', $loker->id_lowongankerja)->get()->toArray();

        $ambilTahap = substr($kodetahap, 3);
        $ambilTahap = str_pad($ambilTahap, 5, 0, STR_PAD_LEFT);

        foreach($tahap as $i => $val) {
            // TAMBAH TAHAPAN
            if ($val && $nama[$i] && $date[$i] && !isset($id_tahap[$i])) {
                $ambilTahap++;
                // MEMBUAT KODE BARU
                $kodetahapbaru = 'THP' . str_pad($ambilTahap - 1, 5, 0, STR_PAD_LEFT);
                $tahapan = Tahap::create([
                    'id_tahap'          => $kodetahapbaru,
                    'lowongankerja_id'  => $loker->id_lowongankerja,
                    'tahap_ke'          => $val,
                    'nama'              => $nama[$i],
                    'tanggal_seleksi'   => $date[$i],
                    'keterangan'        => 'Ini adalah tahapan ke '. $val .' yang akan dilakukan pada '. $date[$i],
                ]);
            }

            if (isset($id_tahap[$i])) {
                if ($val && $nama[$i] && $date[$i] && isset($id_tahap[$i]) == $old_tahap[$i]['id_tahap']) {
                    // UPDATE
                    if ($val !== $old_tahap[$i]['tahap_ke'] || $nama[$i] !== $old_tahap[$i]['nama'] || $date[$i] !== $old_tahap[$i]['tanggal_seleksi']) {
                        # update
                        $tahapan = Tahap::findOrFail($id_tahap[$i])->update([
                            'tahap_ke'          => $val,
                            'nama'              => $nama[$i],
                            'tanggal_seleksi'   => $date[$i],
                            'keterangan'        => 'Ini adalah tahapan ke '. $val .' yang akan dilakukan pada '. $date[$i],
                        ]);
                    }
                }elseif(isset($id_tahap[$i]) == $old_tahap[$i]['id_tahap'] && $val == null && $nama[$i] == null  && $date[$i] == null) {
                    // DELETE
                    $tahapan = Tahap::findOrFail($id_tahap[$i])->delete();
                }

                $tahapan = 'Tidak Terjadi';
                $kodetahap++;
            }
        }

        if($loker){
            //redirect dengan pesan sukses
            return redirect()->route('mitra.main.loker')->with(['success' => 'Data Berhasil Diperbarui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Gagal Diperbarui!']);
        }
    }

    /**
    * menampilkan halman daftar pelamar
    *
    *
    * @return void
    */
    public function pelamar($id)
    {
        // $loker = Loker::where([['mitra_id', 'MRA00002'],['id', $id]])->first();
        // if ($loker == null) {
        //     return redirect()->back()->with('error',' Data tidak data diakses!');
        // }

        $pelamar = Pelamar::where('lowongankerja_id', $id)->get();

        $data = [
            'title' => 'loker',
            'pelamar' => $pelamar,
        ];

        return view('mitra.loker.pelamar', $data);
    }

    /**
    * menampilkan halman daftar rekomend alumni
    *
    *
    * @return void
    */
    public function rekomend($id)
    {
        // DATA BUAT TABLE
        $loker = Lowongankerja::where([['mitra_id', 'MRA00002'],['id', $id]])->first();
        if ($loker == null) {
            return redirect()->back()->with('error',' Data tidak data diakses!');
        }

        // DATA BUAT SELECT2
        $alumni = Alumni::orderBy('jurusan_id', 'ASC')->get();

        $rekomend = Rekomend::where('lowongankerja_id', $id)->get();

        $data = [
            'title' => 'loker',
            'loker' => $loker,
            'rekomend' => $rekomend,
            'alumni' => $alumni,
        ];

        return view('mitra.loker.rekomend', $data);
    }

    /**
    * menampilkan post data rekomend ke DB
    *
    *
    * @return void
    */
    public function rekomendAdd(Request $request)
    {
        // MENGAMBIL ID REKOMEND BARU
        $koderekomend = DB::select('SELECT newidrekomend() AS koderekomend');
        $koderekomend = $koderekomend[0]->koderekomend;

        // CHEKC IF DEFAULTMSG ID CHEKCED
        if (isset($request->defaultMsg)) {
            $judul = 'Selamat! anda direkomendasikan untuk lowongan '. $request->loker .' ini.';
            $text = 'Daftarkan diri anda sekarang, jangan sampai terlewatkan';
            $valjudul = '';
            $valtext = '';
        }else{
            $judul = $request->judul;
            $text = $request->text;
            $valjudul = 'required|min:5|max:80';
            $valtext = 'required|min:5';
        }

        $this->validate($request, [
            'alumni'    => 'required',
            'loker'     => 'required',
            'judul'     => $valjudul,
            'text'      => $valtext,
        ]);

        // REKOMEND CREATE
        $rekomend = Rekomend::create([
            'id'                => $koderekomend,
            'lowongankerja_id'  => $request->loker,
            'judul'             => $judul,
            'text'              => $text,
            'status'            => 'menunggu',
            'created_at'         => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
        ]);

        // $dataAD = array('alumni_id' => $request->alumni,'rekomendasi_id' => $koderekomend);
        $alumni_direkomend = DB::table('alumni_direkomendasikan')->insert(
            array(
            'alumni_id' => $request->alumni,
            'rekomendasi_id' => $koderekomend
        ));

        if($rekomend && $alumni_direkomend){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Data Rekomendasi Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Rekomendasi Gagal Ditambahkan!']);
        }
    }

    /**
    * menampilkan halman daftar tahapan
    *
    *
    * @return void
    */
    public function tahap($id)
    {
        // MENGAMBIL LOEKR DAN CEK APAKAH DATA BISA DIAKSES
        $loker = Lowongankerja::where([['mitra_id', 'MRA00002'],['id', $id]])->first();
        if ($loker == null) {
            return redirect()->back()->with('error',' Data tidak data diakses!');
        }
        // MENGAMBIL TAHAPAN
        $tahap = Tahap::where([['lowongankerja_id', $loker->id]])->get();

        $data = [
            'title' => 'loker',
            'loker' => $loker,
            'tahap' => $tahap,
        ];

        return view('mitra.loker.tahap', $data);
    }

    /**
    * menginsert tahapan baru
    * dengan method POST
    *
    * @return void
    */
    public function tahapAdd(Request $request)
    {
        $kodetahap = DB::select('SELECT newidtahap() AS kodetahap');
        $kodetahap = $kodetahap[0]->kodetahap;

        // CHEKC IF DEFAULTMSG ID CHEKCED
        if (isset($request->defaultMsg)) {
            $keterangan = 'Ini adalah tahapan ke '. $request->tahap_ke .' yang akan dilakukan pada '. Carbon::parse($request->tanggal_seleksi)->format('Y-m-d');
            $valketerangan = '';
        }else{
            $keterangan = $request->keterangan;
            $valketerangan = 'required|min:5';
        }

        $this->validate($request, [
            'nama'              => 'required|min:5',
            'tahap_ke'          => 'required|numeric',
            'tanggal_seleksi'   => 'required|date',
            'keterangan'        => $valketerangan,
        ]);

        $tahap = Tahap::create([
            'id'                => $kodetahap,
            'lowongankerja_id'  => $request->loker_id,
            'nama'              => $request->nama,
            'tahap_ke'          => $request->tahap_ke,
            'tanggal_seleksi'   => $request->tanggal_seleksi,
            'keterangan'        => $keterangan,
            'status'            => '1',
        ]);

        if($tahap){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Data Tahap Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Tahap Gagal Ditambahkan!']);
        }
    }

    /**
    * menampilkan halman seleksi pelamar
    * http://127.0.0.1:8000/mt/lk/tahap/detail/id_tahap
    *
    * @return void
    */
    public function tahapSeleksi($id)
    {
        // JIKA STATUS 1 = BELUM DIMULAI, JIKA STATUS 2 = SEDANG BERLANGSUNG, JIKA STATUS 3 = SUDAH SELESAI
        $loker = Lowongankerja::where([['mitra_id', 'MRA00002'],['id_lowongankerja', $id]])->first();
        if ($loker == null) {
            return redirect()->back()->with('error',' Data tidak dapat diakses!');
        }

        // CARA NGEAKSES
        $alumni = Alumni::orderBy('jurusan_id', 'ASC')->get();
        $tahap = Tahap::where([['id_tahap', $id]])->first();

        if ($tahap->status == '2') {
            // $pelamar = Pelamar::where('lowongankerja_id', $tahap->lowongankerja_id)->get();
            $pelamar = SeleksiPelamar::where('tahap_id', $id)->get();
        }else{
            // $seleksi_pel = SeleksiPelamar::where([['tahap_id', 'THP00010'],['keterangan', 1]])->get();
            $pelamar = SeleksiPelamar::where([['tahap_id', 'THP00010'],['keterangan', 1]])->get();
        }

        $data = [
            'active' => 'loker',
            'tahap' => $tahap,
            'pelamar' => $pelamar,
            'alumni' => $alumni,
            // 'seleksi_pel' => $seleksi_pel,
            'loker_id' => $tahap->lowongankerja_id,
        ];

        if ($tahap->status == '2') {
            return view('mitra.loker.tahap_detail', $data);
        }else{
            return view('mitra.loker.seleksi_pelamar', $data);
        }
    }

    /**
    * menyeleksi alumni alumni
    * dengan method POST
    *
    * @return void
    */
    public function alumniSeleksi(Request $request)
    {
        $this->validate($request, [
            'nilai.*'           => 'required|numeric',
        ]);

        $lolos = $request->loloscek;
        $nilai = $request->nilai;

        Tahap::findOrFail($request->tahap_id)->update([
            'status'    => '2'
        ]);

        foreach ($nilai as $key => $data) {
            if ($lolos[$key] == true) {
                $lolos[$key] = 1;
            }else{
                $lolos[$key] = 0;
            }
            $alumniSeleksi = SeleksiPelamar::create([
                'alumni_id'     => $request->alumni_id[$key],
                'pelamar_id'    => $request->pelamar_id[$key],
                'tahap_id'      => $request->tahap_id,
                'nilai'         => $data,
                'keterangan'    => $lolos[$key],
            ]);
        }

        if($alumniSeleksi){
            //redirect dengan pesan sukses
            return redirect('/mt/lk/tahap/detail/'.$request->tahap_id)->with(['success' => 'Data Seleksi Pelamar Berhasil!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Seleksi Pelamar Gagal!']);
        }
    }

    /**
    * menghapus data loker
    *
    *
    * @return void
    */
    public function hapus(Request $request, $id)
    {
        $loker = Lowongankerja::findOrFail($id);
        $loker->update([
            'kuota'     => 50,
        ]);

        return redirect('/mt/lk/main');
    }
}