<?php

namespace App\Services;

use App\Models\Order;
use App\Models\PriceModifier;

class OrderModifierService
{
    public function attachPriceModifier(Order $order, float $originalPrice)
    {
        $priceModifier = PriceModifier::where('applies_over', '<=', $originalPrice)
            ->orderBy('applies_over', 'desc')
            ->first();

        if ($priceModifier) {
            $order->orderModifiers()->attach($priceModifier->id);
        }
    }
}