<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostingPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'disk_space',
        'bandwidth',
        'email_accounts',
        'databases',
        'price_monthly',
        'price_yearly',
        'promo_price',

        
        'has_ssl',
        'has_backup',
        'has_wordpress',

        'feature_1',
        'feature_2',
        'feature_3',
        'feature_4',
        'feature_5',
    ];

    public function prices()
{
    return $this->hasMany(HostingPackagePrice::class);
}

}
