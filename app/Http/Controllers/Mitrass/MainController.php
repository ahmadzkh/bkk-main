<?php

namespace App\Http\Controllers\Mitra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kantor;
use App\Models\LowonganKerja;
use App\Models\Mitra;
use App\Models\Rekomend;
use App\Models\Rekomendasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
    * menampilkan halman utama main
    *
    *
    * @return void
    */
    public function main()
    {
        // BUAT COUNTING
        $loker = LowonganKerja::where('mitra_id', 'MRA00002')->get();
        $lokerCreated = count($loker);
        $lokerActive = count(LowonganKerja::where([['mitra_id', 'MRA00002'],['status', 'active']])->get());

        // NOTIF
        // CARA DAPETIN REKOMEND DATA YG ID == MRA00002
        $rekomend = Rekomendasi::latest()->paginate(5);

        // $alumniWork =
        // $alumniRekomend =

        // dd($lokerActive, $lokerCreated);

        $data = [
            'active' => 'dashboard',
            'lokerActive' => $lokerActive,
            'lokerCreated' => $lokerCreated,
            'rekomend' => $rekomend,
        ];

        return view('mitra.dashboard.main', $data);
    }

    /**
    * menampilkan halman notifikasi
    *
    *
    * @return void
    */
    public function notif()
    {
        // NOTIF
        $rekomend = Rekomendasi::latest()->paginate(5);

        $data = [
            'title' => 'dashboard',
            'rekomend' => $rekomend,
        ];

        return view('mitra.dashboard.notifikasi', $data);
    }

    /**
    * menampilkan halman profil
    *
    *
    * @return void
    */
    public function profil()
    {
        $mitra = Mitra::findOrFail('MRA00002');
        $kantor = Kantor::where('mitra_id', $mitra->id)->get();
        // dd($kantor[0]['id']);

        $data = [
            'title' => 'profil',
            'mitra' => $mitra,
            'kantor' => $kantor,
        ];

        return view('mitra.profil.main', $data);
    }

    /**
    * menampilkan halman edit profil
    *
    *
    * @return void
    */
    public function prUbah($id)
    {
        if ($id !== 'MRA00002') {
            return redirect('/mt/profil')->with('error', 'Data tidak dapat diakses!');
        }

        $mitra = Mitra::findOrFail($id);
        $user = User::findOrFail($mitra->user_id);
        $kat = ['Information and Technologies','Automotive','Software Engrineering', 'Manufacturing', 'Accounting'];
        $wil = ['Jakarta Timur','Jakarta barat','Bekasi Selatan', 'Bekasi Barat', 'Pondok Gede'];
        $jenis = ['PT','CV','Corp'];

        $data = [
            'title' => 'profil',
            'mitra' => $mitra,
            'kat' => $kat,
            'jenis' => $jenis,
            'user' => $user,
            'wil' => $wil,
        ];

        return view('mitra.profil.ubah', $data);
    }

    /**
    * profile store
    *
    * @param  mixed $request
    * @return void
    */
    public function prUbahPost(Request $request)
    {
        if ($request->id_mitra !== 'MRA00002') {
            return redirect('/mt/profil')->with('error', 'Data tidak dapat diakses!');
        }

        $mitra = Mitra::findOrFail($request->id_mitra);
        $user = User::findOrFail($mitra->user_id);
        // dd($mitra->id, $mitra->nama, $mitra->user_id, $user->id);

        if ($request->password) {
            $valid = 'confirmed|min:5';
        }else{
            $valid = '';
        }

        // MEMVALIDASI
        $this->validate($request, [
            'nama'              => 'required|min:5|max:70',
            'jenis'             => 'required',
            'kategori'          => 'required',
            'no_telp'           => 'required',
            'foto'              => 'image|mimes:png,jpg,jpeg|max:80000',
            'deskripsi'         => 'required',
            'email'             => 'email|max:100|unique:users,email,'.$mitra->user_id,
            'username'          => 'min:2',
            'password'          => $valid,
        ]);

        // SAVING BANNER
        $Image = $request->file('foto');
        // JIKA Image ADA
        if ($Image !== null) {
            // BUAT NAMA BARU
            $nameImage = pathinfo($Image->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFileImage = $nameImage . "-" . time() . Str::random(5) . "." .$Image->getClientOriginalExtension();
            // PINDAHIN DAN DELETE YG LAMA
            $link = str_replace('\\', '/', public_path('assets/img/'));
            unlink($link. $mitra->foto);

            $Image->move(public_path('/assets/img'), $fullFileImage);
        }else{
            $fullFileImage = $mitra->foto;
        }

        // LOKER UPDATE
        $mitra->update([
            'nama'              => $request->nama,
            'jenis'             => $request->jenis,
            'kategori'          => $request->kategori,
            'no_telp'           => $request->no_telp,
            'foto'              => $fullFileImage,
            'overview'          => $request->deskripsi
        ]);

        if ($request->password) {
            $newPw = Hash::make($request->password);
        }else{
            $newPw = $user->password;
        }

        if ($request->username || $request->email) {
            $user->update([
            'email'             => $request->email,
            'username'          => $request->username,
            'password'          => $newPw
            ]);
        }
        // dd($mitra, $user);

        if($mitra){
            //redirect dengan pesan sukses
            return redirect()->route('profil.daftar')->with(['success' => 'Data Berhasil Diperbarui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Gagal Diperbarui!']);
        }
    }

    /**
    * menampilkan halman tambah kantor
    *
    *
    * @return void
    */
    public function kantorAdd()
    {

        $kota = ['Jakarta Timur', 'Jakarta Barat',' Jakarta Selatan', 'Jakarta Utara', 'Kota Bekasi', 'Kabupaten Bekasi'];
        $data = [
            'title' => 'profil',
            'kota'  => $kota,
        ];

        return view('mitra.profil.tambahKantor', $data);
    }

    /**
    * Kantor stroe
    *
    * @param  mixed $request
    * @return void
    */
    public function kantorPost(Request $request)
    {
        // CARI ADA MITAR MAKE AUTH TERUS ID

        // MENGAMBIL ID KANTOR BARU
        $kodekantor = DB::select('SELECT newidkantor() AS kodekantor');
        $kodekantor = $kodekantor[0]->kodekantor;

        // MEMVALIDASI
        $this->validate($request, [
            'alamat'        => 'required|min:5',
            'status'        => 'required',
            'kota'          => 'required',
            'notelp'        => 'required|numeric',
        ]);

        // KANTOR CREATE
        $kantor = Kantor::create([
            'id'            => $kodekantor,
            'mitra_id'      => 'MRA00002',
            'alamat'        => $request->alamat,
            'status'        => $request->status,
            'no_telp'       => $request->notelp,
            'kota'          => $request->kota,
        ]);

        if($kantor){
            //redirect dengan pesan sukses
            return redirect()->route('profil.daftar')->with(['success' => 'Data Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Gagal Ditambahkan!']);
        }
    }

    /**
    * menampilkan halman tambah kantor
    *
    *
    * @return void
    */
    public function kantorEdit($id)
    {
        $kantor = Kantor::findOrFail($id);
        $kota = ['Jakarta Timur', 'Jakarta Barat',' Jakarta Selatan', 'Jakarta Utara', 'Kota Bekasi', 'Kabupaten Bekasi'];
        $data = [
            'title' => 'profil',
            'kota'  => $kota,
            'kantor'  => $kantor,
        ];

        return view('mitra.profil.ubahKantor', $data);
    }

    /**
    * Kantor stroe
    *
    * @param  mixed $request
    * @return void
    */
    public function kantorEditPost(Request $request)
    {
        // CARI ADA MITAR MAKE AUTH TERUS ID

        // MEMVALIDASI
        $this->validate($request, [
            'alamat'        => 'required|min:5',
            'status'        => 'required',
            'kota'          => 'required',
            'notelp'        => 'required|numeric',
        ]);

        // KANTOR CREATE
        $kantor = Kantor::findOrFail($request->id_kantor)->update([
            'alamat'        => $request->alamat,
            'status'        => $request->status,
            'no_telp'       => $request->notelp,
            'kota'          => $request->kota,
        ]);

        if($kantor){
            //redirect dengan pesan sukses
            return redirect()->route('profil.daftar')->with(['success' => 'Data Berhasil Diubah!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Gagal Diubah!']);
        }
    }

    /**
    * Kantor hapus
    *
    * @param  mixed $request
    * @return void
    */
    public function kantorDelete($id)
    {
        // KANTOR DELETE
        Kantor::findOrFail($id)->delete();
    }}