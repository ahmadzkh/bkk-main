<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataNilai extends Model
{
    use HasFactory;

    protected $table = 'data_nilai';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'alumni_id',
        'nama',
        'semester_satu',
        'semester_dua',
        'semester_tiga',
        'semester_empat',
        'semester_lima',
        'semester_enam',
        'nilai_sekolah',
        'nilai_praktek',
        'nilai_ujian',
    ];

    /**
     * Relation to alumni with hasMany
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Function untuk mendapatkan rata2 mtk rapot
     */
    public function mtk_rapot($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Matematika')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['semester_satu'] + $nilai['semester_dua'] + $nilai['semester_tiga'] + $nilai['semester_empat'] + $nilai['semester_lima'] + $nilai['semester_enam']) / 6;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 bing rapot
     */
    public function bing_rapot($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Bahasa Inggris')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['semester_satu'] + $nilai['semester_dua'] + $nilai['semester_tiga'] + $nilai['semester_empat'] + $nilai['semester_lima'] + $nilai['semester_enam']) / 6;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 bindo rapot
     */
    public function bindo_rapot($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Bahasa Indonesia')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['semester_satu'] + $nilai['semester_dua'] + $nilai['semester_tiga'] + $nilai['semester_empat'] + $nilai['semester_lima'] + $nilai['semester_enam']) / 6;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 pkn rapot
     */
    public function pkn_rapot($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Pendidikan Kewarganegaraan')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['semester_satu'] + $nilai['semester_dua'] + $nilai['semester_tiga'] + $nilai['semester_empat'] + $nilai['semester_lima'] + $nilai['semester_enam']) / 6;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 agama rapot
     */
    public function agama_rapot($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Pendidikan Agama')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['semester_satu'] + $nilai['semester_dua'] + $nilai['semester_tiga'] + $nilai['semester_empat'] + $nilai['semester_lima'] + $nilai['semester_enam']) / 6;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 kejuruan rapot
     */
    public function kejuruan_rapot($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Kejuruan')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['semester_satu'] + $nilai['semester_dua'] + $nilai['semester_tiga'] + $nilai['semester_empat'] + $nilai['semester_lima'] + $nilai['semester_enam']) / 6;

            return $average;
        }
    }

    //======================================================================================================================================

    /**
     * Function untuk mendapatkan rata2 mtk akhir
     */
    public function mtk_akhir($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Matematika')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['nilai_sekolah'] + $nilai['nilai_praktek'] + $nilai['nilai_ujian']) / 3;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 bing akhir
     */
    public function bing_akhir($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Bahasa Inggris')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['nilai_sekolah'] + $nilai['nilai_praktek'] + $nilai['nilai_ujian']) / 3;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 bindo akhir
     */
    public function bindo_akhir($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Bahasa Indonesia')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['nilai_sekolah'] + $nilai['nilai_praktek'] + $nilai['nilai_ujian']) / 3;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 pkn akhir
     */
    public function pkn_akhir($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Pendidikan Kewarganegaraan')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['nilai_sekolah'] + $nilai['nilai_praktek'] + $nilai['nilai_ujian']) / 3;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 agama akhir
     */
    public function agama_akhir($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Pendidikan Agama')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['nilai_sekolah'] + $nilai['nilai_praktek'] + $nilai['nilai_ujian']) / 3;

            return $average;
        }
    }

    /**
     * Function untuk mendapatkan rata2 kejuruan akhir
     */
    public function kejuruan_akhir($id)
    {
        $data = $this->where('alumni_id', $id)->where('nama', 'Kejuruan')->get()->toArray();
        // dd($data);
        if ($data === []) {
            return null;
        } else {
            $nilai = $data[0];
            $average = ($nilai['nilai_sekolah'] + $nilai['nilai_praktek'] + $nilai['nilai_ujian']) / 3;

            return $average;
        }
    }

}
