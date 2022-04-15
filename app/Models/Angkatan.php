<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;

    protected $table = 'angkatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'angkatan',
    ];

    /**
     * Relation to alumni with hasMany
     */
    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'angkatan_id', 'id_angkatan');
    }
}