<?php

namespace App\Models;

use App\Http\Admin\Service\Models\ServicePackage;
use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Http\Front\Review\Models\Review;
use App\Traits\HasSecureId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Service extends Model
{
    use HasFactory, HasSlug,HasSecureId;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'image',
        'price',
        'offer_price'
    ];
    protected $secureIdColumn = 'secure_id';
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function package()
    {
        return $this->hasMany(ServicePackage::class, 'service_id');
    }
    public function provider()
    {
        return $this->belongsToMany(ServiceProvider::class, 'service_provider_services');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function timeSlots()
    {
        return $this->hasManyThrough(TimeSlot::class,ServiceProviderService::class,'service_id','service_provider_id','id','service_provider_id');
    }
}
