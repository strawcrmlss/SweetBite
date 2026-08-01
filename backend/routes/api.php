<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Promotion;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use Carbon\Carbon;

Route::get('/products', function () {

    return Product::with('category')
        ->get()
        ->map(function ($product) {

            $promo = Promotion::where(
                'product_id',
                $product->id
            )
            ->where('is_active', 1)
            ->whereDate(
                'start_date',
                '<=',
                Carbon::today()
            )
            ->whereDate(
                'end_date',
                '>=',
                Carbon::today()
            )
            ->first();

            $finalPrice = $product->price;

            if ($promo) {

                $finalPrice =
                    $product->price -
                    (
                        $product->price *
                        $promo->discount_percent / 100
                    );

            }

            return [

                'id' => $product->id,

                'name' => $product->name,

                'description' => $product->description,

                'price' => $product->price,

                'final_price' => round($finalPrice),

                'discount_percent' =>
                    $promo
                    ? $promo->discount_percent
                    : 0,

                'image' => $product->image,

                'stock' => $product->stock,

                'category' => $product->category,

            ];

        });

});

Route::get(
    '/categories',
    [CategoryController::class, 'index']
);

Route::post(
    '/orders',
    [OrderController::class, 'store']
);

Route::get(
    '/orders',
    [OrderController::class, 'index']
);

Route::get('/promotion', function () {

    return Promotion::where(
        'is_active',
        1
    )
    ->orderBy('id', 'desc')
    ->first();

});