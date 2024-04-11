<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    use HasFactory;
    //    protected $table = 'slides';
    protected $fillable = [
        'category_id',
        'title',
        'sub_title',
        'link',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
