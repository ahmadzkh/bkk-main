<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganKerja extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lowongankerja';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lowongankerja';

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
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_lowongankerja',
        'mitra_id',
        'jurusan_id',
        'kantor_id',
        'title',
        'slug',
        'tanggal_posting',
        'kedaluwarsa',
        'posisi',
        'kuota',
        'deskripsi',
        'jenis_pekerjaan',
        'kategori',
        'banner',
        'status',
        'gaji',
    ];

    /**
     * Relation to mitra table
     */
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id', 'id_mitra');
    }

    /**
     * Relation to jurusan table
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id_jurusan');
    }

    /**
     * Relation to kantor table
     */
    public function kantor()
    {
        return $this->belongsTo(Kantor::class, 'kantor_id', 'id_kantor');
    }

    /**
     * Relation to galeri table
     */
    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'lowongankerja_id', 'id_lowongankerja');
    }

    /**
     * Relation to tahap table
     */
    public function tahap()
    {
        return $this->hasMany(Tahap::class, 'lowongankerja_id', 'id_lowongankerja');
    }

    /**
     * Relation to persyaratan table
     */
    public function persyaratan()
    {
        return $this->hasMany(Requirement::class, 'lowongankerja_id', 'id_lowongankerja');
    }

    /**
     * Relation to rekomendasi table
     */
    public function rekomendasi()
    {
        return $this->hasMany(Rekomendasi::class, 'lowongankerja_id', 'id_lowongankerja');
    }

    /**
     * Relation to surat_lamaran_kerja table
     */
    public function surat_lamaran_kerja()
    {
        return $this->hasMany(SuratLamaranKerja::class, 'lowongankerja_id', 'id_lowongankerja');
    }
}