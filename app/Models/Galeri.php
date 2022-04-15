<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_galeri';
    protected $table = 'galeri';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

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
        'id_galeri',
        'lowongankerja_id',
        'foto',
        'keterangan',
    ];

    /**
     * Relation to lowongankerja table
     */
    public function lowongankerja()
    {
        return $this->belongsTo(LowonganKerja::class, 'lowongankerja_id', 'id_lowongankerja');
    }
}