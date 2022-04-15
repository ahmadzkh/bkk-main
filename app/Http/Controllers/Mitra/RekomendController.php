<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use App\Models\Rekomend;
use App\Models\Alumni;
use App\Models\Alumni_direkomendasikan;
use App\Models\Loker;
use App\Models\Jurusan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendController extends Controller
{
    /**
    * menampilkan halman utama rekomendasi
    *
    *
    * @return void
    */
    public function main()
    {
        // DATA BUAT SELECT2
        $alumni = Alumni::orderBy('jurusan_id', 'ASC')->get();
        $jurusan = Jurusan::all();

        // DATA BUAT TABLE
        $loker = Loker::where('mitra_id', 'MRA00002')->get();
        $dataRekomend = DB::table('recommendations')->get();

        // BUAT NGAMBIL NAMA JURUSAN
        foreach ($dataRekomend as $key => $val) {
            $alumniJur[] = Alumni::where('id', $val->id_alumni)->get();
        }

        // dd($alumniJur, $jurusanNam);

        $data = [
            'title' => 'rekomend',
            'loker' => $loker,
            'dataRekomend' => $dataRekomend,
            'alumni' => $alumni,
            'jurusan' => $jurusan,
            'alumniJur' => $alumniJur,
            // 'rekomend' => $rekomend,
            // 'alumni_direkomend' => $alumni_direkomend,
        ];

        return view('mitra.rekomend.main', $data);
    }

    /**
    * menampilkan post data rekomend ke DB
    *
    *
    * @return void
    */
    public function add(Request $request)
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
        // dd($alumni->jurusan->akronim);

        // REKOMEND CREATE
        $rekomend = Rekomend::create([
            'id'                => $koderekomend,
            'lowongankerja_id'  => $request->loker,
            'judul'             => $judul,
            'text'              => $text,
            'status'            => 'menunggu',
            'created_at'         => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
        ]);

        $alumni_direkomend = Alumni_direkomendasikan::create([
            'alumni_id'         => $request->alumni,
            'rekomendasi_id'    => $koderekomend,
        ]);

        if($rekomend && $alumni_direkomend){
            //redirect dengan pesan sukses
            return redirect()->route('rekomend.awal')->with(['success' => 'Data Rekomendasi Berhasil Ditambahkan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Data Rekomendasi Gagal Ditambahkan!']);
        }
    }
}