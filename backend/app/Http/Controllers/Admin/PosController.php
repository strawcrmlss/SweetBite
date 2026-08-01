<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function index()
    {
        return view('admin.pos.index');
    }

    public function checkout(Request $request)
    {
        $cart = $request->cart;

        $subtotal = 0;

        foreach ($cart as $item) {

            $product = Product::findOrFail($item['id']);

            $promo = Promotion::where('product_id', $product->id)
                ->where('is_active', 1)
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->first();

            $harga = $product->price;

            if ($promo) {
                $harga -= ($harga * $promo->discount_percent / 100);
            }

            $subtotal += $harga * $item['qty'];
        }

        $grandTotal = $subtotal;

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => 'ORD' . time(),
            'customer_name' => $request->customer_name,
            'queue_number' => $request->queue_number,
            'cash_received' => $request->cash_received,
            'change_amount' => $request->change_amount,
            'total_price' => $grandTotal,
            'status' => 'paid'
        ]);

        // ==========================
        // Simpan Detail Pesanan
        // ==========================
        foreach ($cart as $item) {

            $product = Product::findOrFail($item['id']);

            $promo = Promotion::where('product_id', $product->id)
                ->where('is_active', 1)
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->first();

            $harga = $product->price;

            if ($promo) {
                $harga -= ($harga * $promo->discount_percent / 100);
            }

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'qty'        => $item['qty'],
                'price'      => $harga,
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'method' => $request->method,
            'amount' => $grandTotal,
            'status' => 'paid'
        ]);

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'method' => $request->method
        ]);
    }

    public function receipt($id)
    {
        $order = Order::with([
            'items.product',
            'payment',
            'user'
        ])->findOrFail($id);

        return view(
            'admin.pos.receipt',
            compact('order')
        );
    }

    public function qris($id)
    {
        $order = Order::with('payment')
            ->findOrFail($id);

        return view(
            'admin.pos.qris',
            compact('order')
        );
    }

    public function markPaid($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'paid'
        ]);

        $order->payment->update([
            'status' => 'paid'
        ]);

        return redirect('/admin/pos/receipt/' . $order->id);
    }
}