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
        'jenis'
    ];
}
