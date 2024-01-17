<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\CustomerInformation;
use App\Models\PriceModifier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrderService
{
    protected $productService;
    protected $orderModifierService;
    protected $customerInformationService;

    public function __construct(
        ProductDataService $productService,
        OrderModifierService $orderModifierService,
        CustomerInformationService $customerInformationService
    ) {
        $this->productService = $productService;
        $this->orderModifierService = $orderModifierService;
        $this->customerInformationService = $customerInformationService;
    }

    public function createOrder(Request $request)
    {
        $user = Auth::user();
        $productsData = $request->input('products');
        $skus = collect($productsData)->pluck('sku')->toArray();

        $contracts = $this->productService->getContracts($skus, $user);
        $skusNotInContracts = array_diff($skus, $contracts->keys()->toArray());
        $priceLists = $this->productService->getPriceLists($skusNotInContracts, $user->pricelist_name);

        $totalPrice = 0;
        $orderProducts = [];

        foreach ($productsData as $productData) {
            $sku = $productData['sku'];
            $product = $this->productService->getProduct($sku, $contracts, $priceLists, $user);
            
            if ($product !== null) {
                $quantity = $productData['quantity'] ?? 1;
                $price = $product->price;

                $totalPrice += $quantity * $price;

                $orderProducts[] = [
                    'product_sku' => $product->sku,
                    'quantity' => $quantity,
                    'price' => $price,
                ];
            }
        }

        $priceModifier = $this->productService->getAppliedPriceModifier($totalPrice);
        $originalPrice = $totalPrice;

        if ($priceModifier) {
            $totalPrice -= ($totalPrice * $priceModifier->value) / 100;
        }

        $order = Order::create([
            'total_price' => $totalPrice,
            'user_id' => $user->getKey(),
        ]);

        $this->orderModifierService->attachPriceModifier($order, $originalPrice);
        $this->customerInformationService->saveCustomerInformation($order, $request->input('contact', []));
        $this->createOrderProducts($order, $orderProducts);
        
        return $order;
    }

    private function createOrderProducts(Order $order, array $orderProductsData)
    {
        $orderProducts = [];

        foreach ($orderProductsData as $orderProductData) {
            $orderProducts[] = new OrderProduct($orderProductData);
        }

        $order->orderProducts()->saveMany($orderProducts);
    }
}