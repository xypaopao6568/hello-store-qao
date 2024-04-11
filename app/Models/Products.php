<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Products extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'name_en',
        'image',
        'slug',
       ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }

    public function images()
    {
        return $this->hasMany(ImagesProducts::class, 'product_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
    public function categories()
    {
        return $this->hasMany(Product_Categories::class, 'product_id');
    }
}
