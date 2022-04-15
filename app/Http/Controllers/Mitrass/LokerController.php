<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Tahap;
use App\Models\Galeri;
use App\Models\Alumni;
use App\Models\Jurusan;
use App\Models\Alumni_direkomendasikan;
use App\Models\LowonganKerja;
use App\Models\Persyaratan;
use App\Models\Rekomend;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LokerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $id_mitra = Mitra::where('user_id', $user_id)->get();
        $loker = LowonganKerja::where('mitra_id', 'MRA00002')->get();

        if (!$loker->isEmpty()) {
            foreach ($loker as $key => $lkr) {
                $requirement[$key++] = Persyaratan::where('lowongankerja_id', $lkr->id_lowongankerja)->get();
                $age[$key++] = ['id' => $lkr->id_lowongankerja, 'date' => Carbon::parse($lkr->tanggal_posting)->diffForHumans()];
            }
        }

        // $data = [
        //     'active' => 'loker',
        //     'loker' => $loker,
        //     'requirement' => $requirement,
        //     'ages' => $age,
        // ];

        return view('mitra.loker.main', [
            'active' => 'loker',
            'loker' => $loker,
            'requirements' => $requirement,
            'ages' => $age
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = [['id' => 'JRSN0004','nama' => 'Rekayasa Perangkat Lunak']];
        $lokasi_kerja = [['id' => 'KTR00001','alamat' => 'Jl. H. Ucok', 'status' => 'Kantor Cabang']];

        $data = [
            'title' => 'loker',
            'jurusan' => $jurusan,
            'lokasi_kerja' => $lokasi_kerja,
            // 'jurusan' => '',
        ];

        return view('mitra.loker.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
            // 'fotos'             => 'nullable|image|mimes:png,jpg,jpeg|max:80000',
            // 'namasec'           => 'nullable|min:5',
        ],[
            // MEMBUAT MESSAGE VALIDASI SENDRI
            'req.min'           => 'Field Requirement must over 7 characters!',
        ]);

        // MENGAMBIL KODE LOKER BARU
        $kodeloker = DB::select('SELECT newidloker() AS kodeloker');
        $kodeloker = $kodeloker[0]->kodeloker;
        $kodetahap = DB::select('SELECT newidtahap() AS kodetahap');
        $kodetahap = $kodetahap[0]->kodetahap;
        $id_mitra = DB::select('SELECT newidmitra() AS id_mitra');
        $id_mitra = $id_mitra[0]->id_mitra;

        // MEMBUAT LOKER
        // MENGAMBIL WAKTU
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        // JIKA WAKTU SEKARANG MELIBHI KEDALUWARSA
        if ($request->kedaluwarsa >= $dateNow){
            $status = 'active';
        }else{
            $status = 'nonactive';
        }

        // SAVING BANNER
        $banner = $request->file('banner');
        // JIKA BANNER ADA
        if ($banner !== null) {
            // BUAT NAMA BARU
            $nameBanner = pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME);
            $fullFileBanner = $nameBanner . "-" . time() . Str::random(5) . "." .$banner->getClientOriginalExtension();
            // PINDAHIN
            $banner->move(public_path('/assets/img'), $fullFileBanner);
        }else{
            $fullFileBanner = null;
        }

        // BUAT LOKER BARU
        $loker = LowonganKerja::create([
            'id'                => $kodeloker,
            // 'mitra_id'          => $id_mitra,
            'jurusan_id'        => $request->jurusan,
            'title'             => $request->title,
            'kategori'          => $request->kategori,
            'tanggal_posting'   => $dateNow,
            'kedaluwarsa'       => $request->kedaluwarsa,
            'posisi'            => $request->posisi,
            'kuota'             => $request->kuota,
            'gaji'              => $request->gaji,
            'lokasi_kerja'      => $request->lokasi_kerja,
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
                $foto->move(public_path('/assets/img'), $fullFileName);
            }
        }
        $galeri = true;

        // SAVING PERSYARATAN
        $req = $request->req;
        foreach ($req as $data) {
            // jika req ada
            if ($data !== null) {
                $requirement = Persyaratan::create([
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
                    'id'                => $kodetahapbaru,
                    'lowongankerja_id'  => $kodeloker,
                    'tahap_ke'          => $val,
                    'nama'              => $nama[$i],
                    'tanggal_seleksi'   => $date[$i],
                    'keterangan'        => 'Ini adalah tahapan ke '. $val .' yang akan dilakukan pada '. $date[$i],
                ]);
            }
            $tahapan = true;
            $kodetahap++;
        }

        if($loker && $galeri && $requirement && $tahapan){
            //redirect dengan pesan sukses
            return redirect()->route('daftar')->with(['success' => 'Data Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Gagal Disimpan!']);
        }
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
