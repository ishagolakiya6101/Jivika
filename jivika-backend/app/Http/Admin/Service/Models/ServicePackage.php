<?php

namespace App\Http\Admin\Service\Models;

use App\Http\Front\Review\Models\Review;
use App\Models\Service;
use App\Traits\HasSecureId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ServicePackage extends Model
{
    use HasFactory, SoftDeletes, HasSlug, HasSecureId;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'service_id',
        'included',
        'excluded',
        'how_work',
        'duration',
        'image'
    ];
    protected $secureIdColumn = 'secure_id';
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function getRatingAttribute()
    {
        return $this->review->isNotEmpty() ? ($this->review->sum('ratings')/$this->review->count()*5) : 0;
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function review()
    {
        return $this->hasMany(Review::class,'package_id');
    }
}
