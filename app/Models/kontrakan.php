<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class kontrakan extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'id_tagihan',
        'id_pedagang',
        'id_blok',
        'tanggal',
        'status',
        'keterangan'
    ];
}
