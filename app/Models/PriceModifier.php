<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceModifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'modifier_type',
        'value',
        'applies_over',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_modifiers')
            ->using(OrderModifier::class)
            ->withTimestamps();
    }
}