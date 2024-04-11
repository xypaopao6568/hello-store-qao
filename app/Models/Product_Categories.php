<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Categories extends Model
{
    use HasFactory;
    protected $table = "product_categories";
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
