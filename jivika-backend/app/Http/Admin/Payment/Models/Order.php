<?php

namespace App\Http\Admin\Payment\Models;

use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Front\Order\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'total_amount', 'status','order_id'];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
