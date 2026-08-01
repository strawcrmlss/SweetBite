<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\PosController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource(
        'admin/categories',
        CategoryController::class
    );

    Route::resource(
        'admin/products',
        ProductController::class
    );

    Route::resource(
        'admin/orders',
        OrderController::class
    );

    Route::resource(
        'admin/promotions',
        PromotionController::class
    );

    /*
    |--------------------------------------------------------------------------
    | PROFILE BAWAAN LARAVEL (/profile)
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | ADMIN PROFILE (/admin/profile)
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/profile',
        [AdminProfileController::class, 'index']
    );

    Route::get(
        '/admin/profile/edit',
        [AdminProfileController::class, 'edit']
    );

    Route::put(
        '/admin/profile/update',
        [AdminProfileController::class, 'update']
    );

    Route::delete(
        '/admin/profile/delete',
        [AdminProfileController::class, 'destroy']
    );

    /*
    |--------------------------------------------------------------------------
    | REPORT
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/reports',
        [ReportController::class, 'index']
    );

    Route::get(
        '/admin/reports/pdf',
        [ReportController::class, 'exportPdf']
    );

    /*
    |--------------------------------------------------------------------------
    | POS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/pos',
        [PosController::class, 'index']
    )->name('admin.pos');

    Route::post(
        '/admin/pos/checkout',
        [PosController::class, 'checkout']
    )->name('admin.pos.checkout');

    Route::get(
        '/admin/pos/receipt/{id}',
        [PosController::class, 'receipt']
    )->name('admin.pos.receipt');

    Route::get(
        '/admin/pos/qris/{id}',
        [PosController::class, 'qris']
    )->name('admin.pos.qris');

    Route::post(
        '/admin/pos/qris/{id}/paid',
        [PosController::class, 'markPaid']
    )->name('admin.pos.qris.paid');

});

require __DIR__.'/auth.php';