<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }

    public function edit(Order $order)
    {
        return view(
            'admin.orders.edit',
            compact('order')
        );
    }

    public function update(
        Request $request,
        Order $order
    )
    {
        $order->update([
            'status' => $request->status
        ]);

        return redirect('/admin/orders');
    }
}
