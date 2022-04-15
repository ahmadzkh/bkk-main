<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $table = 'pelamar';

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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pelamar',
        'lowongankerja_id',
        'tanggal_kirim',
    ];

    /**
     * Relation to seleksi_pelamar table
     */
    public function seleksi_pelamar()
    {
        return $this->hasMany(SeleksiPelamar::class, 'pelamar_id', 'id_pelamar');
    }

    /**
     * Relation to alumni_mendaftar_pelamar table
     */
    public function alumni_mendaftar_pelamar()
    {
        return $this->hasMany(AlumniMendaftarPelamar::class, 'pelamar_id', 'id_pelamar');
    }
}
