<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mitra';

    protected $table = 'mitra';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Membuat timestamps tidak automatis.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_mitra',
        'user_id',
        'kantor_pusat',
        'jenis',
        'nama',
        'kategori',
        'wilayah',
        'no_telp',
        'website',
        'overview',
        'foto',
        'created_at',
        'updated_at',
    ];


    /**
     * Procedure add_newalumni
     */
    public function add_newmitra($jurusan_id, $angkatan_id ,$nama, $nis, $nisn, $password, $created_at, $updated_at)
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
        $query = DB::select("CALL tambah_alumni('$id_alumni', '$jurusan_id', '$angkatan_id', '$user_id', '$nama', '$nis', '$nisn', '$password')");

        // dd($query);

        // $query = $query->toObject();

        return $query;
    }

    /**
     * Relation to users table
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relation to lowongankerja table
     */
    public function lowongankerja()
    {
        return $this->hasMany(LowonganKerja::class, 'mitra_id', 'id_mitra');
    }

    /**
     * Relation to kantor table
     */
    public function kantor()
    {
        return $this->hasMany(Kantor::class, 'mitra_id', 'id_mitra');
    }
}