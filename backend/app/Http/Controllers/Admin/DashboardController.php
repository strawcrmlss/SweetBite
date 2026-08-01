<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Promotion;

class DashboardController extends Controller
{
   public function index()
{
    $totalCategories = \App\Models\Category::count();
    $totalProducts = \App\Models\Product::count();
    $totalOrders = \App\Models\Order::count();
    $totalPromotions = \App\Models\Promotion::count();

    $latestProducts = \App\Models\Product::latest()
                        ->take(5)
                        ->get();
    $totalRevenue = \App\Models\Order::where(
    'status',
    'completed'
                    )->sum('total_price');

    $todayOrders = \App\Models\Order::whereDate(
    'created_at',
    today()
    )->count();

    $latestOrders = \App\Models\Order::latest()
                    ->take(5)
                    ->get();

    $salesData = [
    ['day' => '1 Jul', 'sales' => 875000],
    ['day' => '2 Jul', 'sales' => 1200000],
    ['day' => '3 Jul', 'sales' => 950000],
    ['day' => '4 Jul', 'sales' => 1100000],
    ['day' => '5 Jul', 'sales' => 1025000],
];

    return view('admin.dashboard', compact(
        'totalCategories',
        'totalProducts',
        'totalOrders',
        'totalPromotions',
        'latestProducts',
        'salesData',
        'totalRevenue',
        'todayOrders',
        'latestOrders'
    ));
}
}