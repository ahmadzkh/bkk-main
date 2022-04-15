<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Kantor;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Wilayah;

class MitraController extends Controller
{
    protected $mitraModel;
    protected $kantorModel;

    public function __construct()
    {
        $this->mitraModel = Mitra::all();
        $this->kantorModel = Kantor::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_mitra = Mitra::orderBy('updated_at', 'ASC')->get();

        return view('admin.mitra.main', [
            'active' => 'mitra',
            'data_mitra' => $data_mitra,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = ['PT', 'CV'];
        $wilayah = ['Bekasi', 'Jakarta'];
        $kategori = [
            'Ekstratif',
            'Industri atau Manufaktur',
            'Jasa',
            'Agraris',
            'Dagang',
        ];

        return view('admin.mitra.add', [
            'active' => 'mitra',
            'jenis' => $jenis,
            'wilayah' => $wilayah,
            'kategori' => $kategori,
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
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'kategori' => 'required',
            'wilayah' => 'required',
            'website' => 'required',
            'tahun_gabung' => 'required|date',
            'no_telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:15|min:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $mitra = new Mitra;
        $id_mitra = DB::select("SELECT newidmitra() AS id_mitra");
        $id_mitra = $id_mitra[0];
        $id_mitra = $id_mitra->id_mitra;

        $user = new User;
        $id_user = DB::select("SELECT newiduser() AS id_user");
        $id_user = $id_user[0];
        $id_user = $id_user->id_user;

        $kantor = new Kantor();
        $id_kantor = DB::select("SELECT newidkantor() AS id_kantor");
        $id_kantor = $id_kantor[0];
        $id_kantor = $id_kantor->id_kantor;

        /**
         * Insert to field users
         */
        $data_user = User::create([
            'id' => $id_user,
            'level_id' => 'LVL00003',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        // dd($request->all());

        /**
         * Insert to field alumni
         */
        $data_mitra = Mitra::create([
            'id_mitra' => $id_mitra,
            'user_id' => $id_user,
            'kantor_pusat' => $request->alamat,
            'jenis' => $request->jenis,
            'nama' => strtoupper($request->nama),
            'kategori' => $request->kategori,
            'wilayah' => $request->wilayah,
            'no_telp' => $request->no_telp,
            'website' => $request->website,
            'foto' => 'default-profile.png',
            'created_at' => $request->tahun_gabung,
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        /**
         * Insert kantor_pusat
         */
        $data_kantor = Kantor::create([
            'id_kantor' => $id_kantor,
            'mitra_id' => $id_mitra,
            'alamat' => $request->alamat,
            'wilayah' => $request->wilayah,
            'no_telp' => $request->no_telp,
        ]);

        return redirect('/ad/mt/main')->with('success', 'Mitra baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt = decrypt($id);
        $mitra = $this->mitraModel->where('id_mitra' ,$decrypt)->first();
        $kantor = $this->kantorModel->where('mitra_id', $decrypt);
        // dd($kantor);

        return view('admin.mitra.detail', [
            'active' => 'mitra',
            'mitra' => $mitra,
            'kantor' => $kantor,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
