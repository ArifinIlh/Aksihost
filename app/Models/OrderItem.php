<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_type',
        'product_name',
        'price',
        'status',
        'meta',
    ];
// Di model Domain.php
protected $casts = [
    'expired_at' => 'datetime',
];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function getMetaArrayAttribute()
    {
        return json_decode($this->meta, true) ?? [];
    }
}
