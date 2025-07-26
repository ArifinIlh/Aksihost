<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'price',
        'status',
        // tambahkan field lain sesuai tabelmu
    ];
}
