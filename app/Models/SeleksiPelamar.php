<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeleksiPelamar extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seleksi_pelamar';

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
        'alumni_id',
        'pelamar_id',
        'tahap_id',
        'nilai',
        'keterangan',
    ];

    /**
     * Relation to pelamar table
     */
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id', 'id_pelamar');
    }

    /**
     * Relation to tahap table
     */
    public function tahap()
    {
        return $this->belongsTo(Tahap::class, 'tahap_id', 'id_tahap');
    }

    /**
     * Relation to alumni table
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id_alumni');
    }
}