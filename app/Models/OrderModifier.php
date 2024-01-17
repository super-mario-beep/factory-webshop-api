<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderModifier extends Pivot
{
    protected $table = 'order_modifiers';

    protected $fillable = [
        'order_id',
        'price_modifier_id',
    ];
}