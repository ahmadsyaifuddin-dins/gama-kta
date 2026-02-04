<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;

    protected $table = 'managements';

    protected $fillable = [
        'nama',
        'jabatan',
        'no_hp',
        'foto',
        'periode_mulai',
        'periode_selesai',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
