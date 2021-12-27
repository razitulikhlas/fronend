<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name_driver', 'email', 'phone', 'nomor_stnk', 'plat_kendaraan', 'nik', 'photo_profile', 'photo_stnk', 'photo_ktp', 'rating', 'saldo', 'status', 'fcm'
    ];
}
