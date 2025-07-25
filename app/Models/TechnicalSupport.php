<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalSupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'attachment',
        'category',
        'status',
        'response_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
