<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniMendaftarPelamar extends Model
{
    use HasFactory;

    protected $table = 'alumni_mendaftar_pelamar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'alumni_id',
        'pelamar_id',
    ];

    /**
     * Relation to alumni table
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id_alumni');
    }

    /**
     * Relation to pelamar table
     */
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id', 'id_pelamar');
    }
}