<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'jenis_simpanan',
        'jumlah',
        'tanggal_bayar',
        'keterangan',
        'bukti_transfer',
        'user_id',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'jumlah' => 'decimal:2',
    ];

    // Kebalikan relasi: Simpanan milik satu Anggota
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Simpanan diinput oleh User (Admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
