<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerima',
        'user_id',
        'perihal',
        'agenda',
        'tanggal',
        'waktu',
        'tempat',
        'send_to',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}