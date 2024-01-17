<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\CreateOrderService;

class OrderController extends Controller
{

    protected $createOrderService;

    public function __construct(CreateOrderService $createOrderService)
    {
        $this->createOrderService = $createOrderService;
    }

    /**
     * Display the details of a specific order.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($order_id)
    {
        $order = Order::with(['orderProducts', 'customerInformation', 'orderModifiers'])->find($order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found.'], 404);
        }

        return response()->json(['order' => $order]);
    }

    /**
     * Create a new order with an array of products.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->pricelist_name === null) {
            $order = $this->createOrderService->createOrderWithoutPricelist($request);
            return response()->json(['message' => 'Order created successfully. Your order number is FWA-00' . $order->getKey()], 201);
        }

        $order = $this->createOrderService->createOrder($request);

        return response()->json(['message' => 'Order created successfully. Your order number is FWA-00' . $order->getKey()], 201);
    }
}
