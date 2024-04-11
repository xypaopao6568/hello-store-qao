<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'payment',
        'info',
        'price',
        'status',
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
