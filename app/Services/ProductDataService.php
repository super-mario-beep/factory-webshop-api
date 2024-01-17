<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Pricelist;
use App\Models\PriceModifier;
use Illuminate\Support\Collection;

class ProductDataService
{
    public function getContracts(array $skus, $user): Collection
    {
        return Contract::whereIn('sku', $skus)
            ->where('user_id', $user->getKey())
            ->get()
            ->keyBy('sku');
    }

    public function getPriceLists(array $skus, $pricelistName): Collection
    {
        return Pricelist::whereIn('sku', $skus)
            ->where('name', $pricelistName)
            ->get()
            ->keyBy('sku');
    }

    public function getProduct($sku, Collection $contracts, Collection $priceLists, $user)
    {
        if ($contracts->has($sku)) {
            return $contracts[$sku];
        }

        return $priceLists->has($sku) ? $priceLists[$sku] : null;
    }

    public function getAppliedPriceModifier($totalPrice)
    {
        return PriceModifier::where('applies_over', '<=', $totalPrice)
            ->orderBy('applies_over', 'desc')
            ->first();
    }
}
