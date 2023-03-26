<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class pembayaran extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'id_tagihan',
        'id_pedagang',
        'id_petugas',
        'tanggal_pembayaran',
        'nominal',
        'keterangan'
    ];
}
