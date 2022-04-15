<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'data_pekerjaan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'alumni_id',
        'perusahaan',
        'bidang',
        'jabatan',
        'tahun_mulai',
        'tahun_lulus',
        'status',
    ];

    /**
     * Relation to alumni with belongsto
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id_alumni');
    }   
}