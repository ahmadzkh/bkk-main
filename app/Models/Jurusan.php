<?php

namespace App\Models;

use App\Http\Controllers\LokerController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

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
        'id_jurusan',
        'nama',
        'akronim',
    ];

    /**
     * Relation to alumni with hasMany
     */
    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'jurusan_id', 'id_jurusan');
    }

    /**
     * Relation to lowongankerja with hasMany
     */
    public function lowongankerja()
    {
        return $this->hasMany(LowonganKerja::class, 'jurusan_id', 'id_jurusan');
    }
}
