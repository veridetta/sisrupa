<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class pedagang extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'id_users',
        'ttl',
        'alamat',
        'telp',
        'jk',
        'jenis',
        'status', //1 = sewa 0 = pengunjung
        'id_pasar' //1 = Pasar Cigasong  2 = Pasar Kadipaten
    ];
}
