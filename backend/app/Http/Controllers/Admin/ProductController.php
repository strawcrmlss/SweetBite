<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

public function store(Request $request)
{
    $imagePath = null;

    if ($request->hasFile('image')) {

        $imagePath = $request
            ->file('image')
            ->store('products', 'public');
    }

    Product::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
    ]);

    return redirect('/admin/products');
}
 
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        Product $product
    ) {
        $imagePath = $product->image;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect('/admin/products');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/admin/products');
    }
}