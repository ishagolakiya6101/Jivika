<?php

namespace App\Http\Admin\ServiceProvider\Models;

use App\Models\ServiceProviderService;
use App\Models\User;
use App\Models\UserService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ServiceProvider extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title','description','user_id'
    ];
    public function services()
    {
        return $this->hasMany(ServiceProviderService::class);
    }
    public function address()
    {
        return $this->hasOne(ServiceProviderAddress::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
