<?php

namespace App\Models;

use App\Traits\HasSecureId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Category extends Model
{
    use HasFactory,HasSlug, HasSecureId;
    protected $fillable = [
        'slug',
        'name',
        'description',
        'parent_id',
        'image'
    ];
    protected $secureIdColumn = 'secure_id';
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'parent_id')->select('id','name','slug','description','image','parent_id');
    }
    public function child_category()
    {
        return $this->hasMany(Category::class,'parent_id')->select('name','slug','description','image','parent_id');
    }
}
