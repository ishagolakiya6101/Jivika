<?php

namespace App\Http\Admin\ServiceProvider\Models;

use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\Service\Models\ServicePackage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id','order_id','quantity','service_provider_id','price','status'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function package()
    {
        return $this->belongsTo(ServicePackage::class);
    }
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
