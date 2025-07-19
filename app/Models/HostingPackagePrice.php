<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostingPackagePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'hosting_package_id',
        'duration_months',
        'original_price',
        'discounted_price',
    ];
    public function hostingPackage()
{
    return $this->belongsTo(HostingPackage::class);
}

}
