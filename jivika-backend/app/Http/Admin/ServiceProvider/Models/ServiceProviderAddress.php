<?php

namespace App\Http\Admin\ServiceProvider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProviderAddress extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'service_provider_id',
        'flat_building_no',
        'street',
        'city',
        'state',    
        'zip_code',
        'country',
        'landmark',
        'latitude',
        'longitude',
    ];
}
