<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class blok extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'nomor_kios',
        'status',
        'blok',
        'id_pasar'
    ];
}
