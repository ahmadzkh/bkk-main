<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratLamaranKerja extends Model
{
    use HasFactory;

    protected $table = 'surat_lamaran_kerja';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_slp',
        'alumni_id',
        'lowongankerja_id',
        'nama',
        'file',
    ];

    /**
     * Relation to alumni with hasMany
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Relation to lowongankerja with hasMany
     */
    public function lowongankerja()
    {
        return $this->belongsTo(LowonganKerja::class, 'alumni_id', 'id_alumni');
    }
}