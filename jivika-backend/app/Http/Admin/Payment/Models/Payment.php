<?php

namespace App\Http\Admin\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'amount', 'razorpay_payment_id', 'status','order_id'];
    public function order() : BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
