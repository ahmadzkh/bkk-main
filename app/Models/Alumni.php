<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_alumni';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_alumni',
        'jurusan_id',
        'angkatan_id',
        'user_id',
        'kerja_active',
        'kuliah_active',
        'usaha_active',
        'nama',
        'nis',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'agama',
        'alamat',
        'no_telp',
        'berat_badan',
        'tinggi_badan',
        'foto',
        'created_at',
        'updated_at',
    ];

    /**
     * Procedure add_newalumni
     */
    public function add_newalumni($jurusan_id, $angkatan_id ,$nama, $nis, $nisn, $password, $created_at, $updated_at)
    {
        // id baru alumni
        $alumni = new Alumni;
        $id_alumni = DB::select("SELECT newidalumni() AS id_alumni");
        $id_alumni = $id_alumni[0];
        $id_alumni = $id_alumni->id_alumni;

        // id baru user
        $user = new User;
        $user_id = DB::select("SELECT newiduser() AS user_id");
        $user_id = $user_id[0];
        $user_id = $user_id->user_id;

        //Manggil PROCEDURE
        $query = DB::select("CALL tambah_alumni('$id_alumni', '$jurusan_id', '$angkatan_id', '$user_id', '$nama', '$nis', '$nisn', '$password', '$created_at', '$updated_at')");

        // dd($query);

        // $query = $query->toObject();

        return $query;
    }

    /**
     * get foto
     */
    public function getFoto()
    {
        if ($this->foto === null) {
            return asset('/assets/img/default-profile.png');
        }
        return asset('/assets/img/'.$this->foto);
    }

    /**
     * Relation to users table
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relation to jurusan table
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id_jurusan');
    }

    /**
     * Relation to jurusan table
     */
    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'angkatan_id', 'id_angkatan');
    }

    /**
     * Relation to data_nilai with hasMany
     */
    public function data_nilai()
    {
        return $this->hasMany(DataNilai::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Relation to data_pekerjaan with hasMany
     */
    public function data_pekerjaan()
    {
        return $this->hasMany(DataPekerjaan::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Relation to data_pendidikan with hasMany
     */
    public function data_pendidikan()
    {
        return $this->hasMany(DataPendidikan::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Relation to data_prestasi with hasMany
     */
    public function data_prestasi()
    {
        return $this->hasMany(DataPrestasi::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Relation to data_prestasi with hasMany
     */
    public function data_wirausaha()
    {
        return $this->hasMany(DataWirausaha::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Relation to alumni_direkomendasikan
     */
    public function alumni_direkomendasikan()
    {
        return $this->hasMany(AlumniDirekomendasikan::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Relation to alumni_mendaftar_pelamar
     */
    public function alumni_mendaftar_pelamar()
    {
        return $this->hasMany(AlumniMendaftarPelamar::class, 'alumni_id', 'id_alumni');
    }
}