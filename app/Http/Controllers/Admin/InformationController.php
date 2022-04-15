<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Informasi;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    protected $informasiModel;
    protected $adminModel;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->adminModel = new Admin;
        $this->informasiModel = new Informasi();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = $this->informasiModel->orderBy('created_at', 'DESC')->get();

        // dd($news);
        $data = [
            'active' => 'informations',
            'news' => $news
        ];

        return view('admin.informations.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'admin' => $this->adminModel->first(),
            'active' => 'informations'
        ];

        return view('admin.informations.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'title' => 'required',
            'kategori' => 'required',
            'banner' => 'required',
            'photo1' => 'required',
            'photo2' => 'required',
            'photo3' => 'required',
            'content' => 'required',
        ]);

        // buat otomatis slug
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));

        $id_informasi = DB::select('SELECT newidinformasi() AS id_informasi');
        $id_informasi = $id_informasi[0];
        $id_informasi = $id_informasi->id_informasi;

        // SAVING BANNER
        $banner = $request->file('banner');
        // JIKA BANNER ADA
        if ($banner !== null) {
            // BUAT NAMA BARU
            $nameBanner = pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFileBanner = $nameBanner . "-" . time() . Str::random(5) . "." .$banner->getClientOriginalExtension();
            // PINDAHIN
            $banner->move(public_path('/assets/img/news'), $fullFileBanner);
        }else{
            $fullFileBanner = null;
        }
        dd($banner);
        $data_informasi = Informasi::create([
            'id_informasi' => $id_informasi,
            'admin_id' => $request->admin_id,
            'title' => $request->title,
            'slug' => $slug,
            'kategori' => $request->kategori,
            'banner' => $banner

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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