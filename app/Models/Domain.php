<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = ['name', 'price',];

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
// Di model Domain.php
protected $casts = [
    'expired_at' => 'datetime',
];


}
