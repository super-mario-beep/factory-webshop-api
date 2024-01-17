<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected  $fillable = ['total_price', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderModifiers()
    {
        return $this->belongsToMany(PriceModifier::class, 'order_modifiers')
            ->using(OrderModifier::class)
            ->withTimestamps();
    }

    public function customerInformation()
    {
        return $this->hasOne(CustomerInformation::class);
    }
}