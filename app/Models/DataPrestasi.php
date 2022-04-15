<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPrestasi extends Model
{
    use HasFactory;

    protected $table = 'data_prestasi';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'alumni_id',
        'nama',
        'peringkat',
        'tingkat',
        'penyelenggara',
        'text',
        'foto',
    ];

    /**
     * Relation to alumni with hasMany
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id_alumni');
    }
}