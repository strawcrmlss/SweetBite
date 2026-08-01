<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('product')->latest()->get();

        return view(
            'admin.promotions.index',
            compact('promotions')
        );
    }

    public function create()
    {
        $products = Product::all();

        return view(
            'admin.promotions.create',
            compact('products')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'title' => 'required',
            'description' => 'required',
            'discount_percent' => 'required|numeric|min:1|max:100',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

       Promotion::create([
    'product_id' => $request->product_id,
    'title' => $request->title,
    'description' => $request->description,
    'discount_percent' => $request->discount_percent,
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'is_active' => $request->is_active,
    ]);

        return redirect('/admin/promotions')
            ->with('success', 'Promo berhasil ditambahkan');
    }

    public function edit(Promotion $promotion)
    {
        $products = Product::all();

        return view(
            'admin.promotions.edit',
            compact(
                'promotion',
                'products'
            )
        );
    }

    public function update(
        Request $request,
        Promotion $promotion
    )
    {
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'title' => 'required',
            'description' => 'required',
            'discount_percent' => 'required|numeric|min:1|max:100',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $promotion->update([
            'product_id' => $request->product_id,
            'title' => $request->title,
            'description' => $request->description,
            'discount_percent' => $request->discount_percent,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect('/admin/promotions')
            ->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect('/admin/promotions')
            ->with('success', 'Promo berhasil dihapus');
    }
}