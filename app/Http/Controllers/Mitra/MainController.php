<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Kantor;
use App\Models\Lowongankerja;
use App\Models\Mitra;
use App\Models\Rekomend;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $user = auth()->user()->id;
        $user = Mitra::where('user_id',auth()->user()->id)->first();
        $id_mitra = $user->id_mitra;
        $loker = Lowongankerja::where('mitra_id', $id_mitra)->get();
        $lokerCreated = count($loker);
        $lokerActive = count(Lowongankerja::where([['mitra_id', $id_mitra],['status', '1']])->get());

        // NOTIF
        // CARA DAPETIN REKOMEND DATA YG ID == MRA00002
        $rekomend = Rekomend::latest()->paginate(5);

        // $alumniWork =
        // $alumniRekomend =

        // dd($lokerActive, $lokerCreated);

        $data = [
            'active' => 'dashboard',
            'lokerActive' => $lokerActive,
            'lokerCreated' => $lokerCreated,
            'rekomend' => $rekomend,
        ];

        return view('mitra.dashboard.dashboard', $data);
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
        $rekomend = Rekomend::latest()->paginate(5);

        $data = [
            'active' => 'dashboard',
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
        $user_id = auth()->user()->id;
        $mitra = Mitra::where('user_id', $user_id)->first();
        $kantor = Kantor::where('mitra_id', $mitra->id_mitra)->get();

        if ($mitra->foto == 'default-company.png') {
            $urlImg = '/assets/img/imp/';
        }else{
            $urlImg = '/assets/img/mitra/';
        }

        $data = [
            'active' => 'profil',
            'mitra' => $mitra,
            'kantor' => $kantor,
            'urlImg' => $urlImg,
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
        $user_id = auth()->user()->id;
        $mitra = Mitra::findOrFail($id);
        if ($user_id !== $mitra->user_id) {
            return redirect('/mt/profil')->with('error', 'Data tidak dapat diakses!');
        }

        $user = User::findOrFail($mitra->user_id);
        $kat = ['Information and Technologies','Automotive','Software Engrineering', 'Manufacturing', 'Accounting'];
        $wil = ['Jakarta Timur','Jakarta barat','Bekasi Selatan', 'Bekasi Barat', 'Pondok Gede'];
        $jenis = ['PT','CV','Corp'];

        if ($mitra->foto == 'default-company.png') {
            $urlImg = '/assets/img/imp/';
        }else{
            $urlImg = '/assets/img/';
        }

        $data = [
            'active' => 'profil',
            'mitra' => $mitra,
            'kat' => $kat,
            'jenis' => $jenis,
            'user' => $user,
            'wil' => $wil,
            'urlImg' => $urlImg,
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
        $user_id = auth()->user()->id;
        $mitra = Mitra::findOrFail($request->id_mitra);
        if ($user_id !== $mitra->user_id) {
            return redirect('/mt/profil')->with('error', 'Data tidak dapat diakses!');
        }

        $user = User::findOrFail($user_id);

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
            $link = str_replace('\\', '/', public_path('assets/img/mitra/'));

            // MOVE IF GAMBAR TIDAK SAMA DENGAN DEFAULT
            if ($mitra->foto !== 'default-company.png') {
                unlink($link. $mitra->foto);
            }

            $Image->move(public_path('/assets/img/mitra'), $fullFileImage);
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

        if($mitra){
            //redirect dengan pesan sukses
            return redirect()->route('mitra.profile')->with(['success' => 'Data Berhasil Diperbarui!']);
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
            'active' => 'profil',
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
        $user_id = auth()->user()->id;
        $mitra = Mitra::where('user_id', $user_id)->first();

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
            'id_kantor'            => $kodekantor,
            'mitra_id'      => $mitra->id_mitra,
            'alamat'        => $request->alamat,
            'status'        => $request->status,
            'wilayah'        => $request->kota,
            'no_telp'       => $request->notelp,
        ]);

        if($kantor){
            //redirect dengan pesan sukses
            return redirect()->route('mitra.profile')->with(['success' => 'Data Berhasil Ditambahkan!']);
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
            'active' => 'profil',
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
            'wilayah'          => $request->kota,
        ]);

        if($kantor){
            //redirect dengan pesan sukses
            return redirect()->route('mitra.profile')->with(['success' => 'Data Berhasil Diubah!']);
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
    }
}