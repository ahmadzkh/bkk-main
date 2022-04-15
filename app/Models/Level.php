<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'level';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_level',
        'nama',
        'keterangan',
    ];

    /**
     * Relation to user
     */
    public function user()
    {
        return $this->hasMany(User::class, 'level_id', 'id_level');
    }
}