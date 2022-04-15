<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataWirausaha extends Model
{
    use HasFactory;

    protected $table = 'data_wirausaha';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'alumni_id',
        'nama',
        'bidang',
        'status',
    ];

    /**
     * Relation to alumni with hasMany
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id_alumni');
    }
}