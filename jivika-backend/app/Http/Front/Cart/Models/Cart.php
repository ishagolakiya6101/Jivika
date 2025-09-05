<?php

namespace App\Http\Front\Cart\Models;

use App\Http\Admin\Service\Models\ServicePackage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id', 'package_id', 'quantity'];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getPriceAttribute()
    {
        return ($this->attributes['quantity'] * $this->package->price);
    }
    public function package()
    {
        return $this->belongsTo(ServicePackage::class)->select('name','id','price');
    }

}
