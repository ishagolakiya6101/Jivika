<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Http\Admin\Address\Models\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes, HasRoles; // Add the SoftDeletes trait

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phonenumber',
        'uuid','profile'
    ];
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4();
            $model->profile = request()->profile ?? "https://i.pravatar.cc/300?u=".$model->uuid;
        });
    }

    // Define the relationship with addresses
    public function addresses()
    {
        return $this->hasMany(Address::class)->select('user_id','flat_building_no','street','city','state','zip_code','country','landmark','address_type','default_address','id');
    }
    public function address()
    {
        return $this->hasOne(Address::class)->where('default_address',1);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function provider()
    {
        return $this->hasOne(ServiceProvider::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
