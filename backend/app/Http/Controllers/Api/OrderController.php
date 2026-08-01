<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => 1,
            'order_code' =>
                'ORD-' . time(),
            'total_price' =>
                $request->total_price,
            'status' => 'pending'
        ]);

        foreach ($request->items as $item) {

            OrderItem::create([
                'order_id' =>
                    $order->id,

                'product_id' =>
                    $item['product_id'],

                'qty' =>
                    $item['qty'],

                'price' =>
                    $item['price']
            ]);
        }

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }

    public function index()
    {
        return Order::with('items.product')
            ->latest()
            ->get();
    }
}
