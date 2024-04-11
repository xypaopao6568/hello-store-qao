<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
