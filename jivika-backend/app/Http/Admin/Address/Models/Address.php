<?php

namespace App\Http\Admin\Address\Models;

use App\Models\User;
use App\Traits\HasSecureId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes,HasSecureId; // Add the SoftDeletes trait

    protected $fillable = [
        'user_id',
        'flat_building_no',
        'street',
        'city',
        'state',
        'zip_code',
        'country',
        'landmark',
        'address_type',
        'default_address'
    ];
    protected $secureIdColumn = 'secure_id';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
