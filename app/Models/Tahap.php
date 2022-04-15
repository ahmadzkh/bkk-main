<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahap extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tahap';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tahap';

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
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_tahap',
        'lowongankerja_id',
        'nama',
        'tahap_ke',
        'tanggal_seleksi',
        'keterangan',
        'status'
    ];

    /**
     * Relation to lowongankerja table
     */
    public function lowongankerja()
    {
        return $this->belongsTo(LowonganKerja::class, 'lowongankerja_id', 'id_lowongankerja');
    }
}