<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Categories extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'name_en',
        'image',
        'slug',
        'description',
       ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }
    public function products()
    {
        return $this->hasMany(Product_Categories::class, 'category_id');
    }
}
