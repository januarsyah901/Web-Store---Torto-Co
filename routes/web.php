<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth',AuthAdmin::class])->group(function () {
    // Index Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Brands
    Route::get('/admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brands/add', [AdminController::class, 'add_brand'])->name('admin.add_brand');
    Route::post('/admin/brands/store', [AdminController::class, 'store_brand'])->name('admin.store_brand');
    Route::get('/admin/brands/edit/{id}', [AdminController::class, 'edit_brand'])->name('admin.edit_brand');
    Route::put('/admin/brands/update', [AdminController::class, 'update_brand'])->name('admin.update_brand');
    Route::delete('/admin/brands/{id}', [AdminController::class, 'delete_brand'])->name('admin.delete_brand');

    // Category
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/add', [AdminController::class, 'add_category'])->name('admin.add_category');
    Route::post('/admin/categories/store', [AdminController::class, 'store_category'])->name('admin.store_category');
    Route::get('/admin/categories/edit/{id}', [AdminController::class, 'edit_category'])->name('admin.edit_category');
    Route::put('/admin/categories/update', [AdminController::class, 'update_category'])->name('admin.update_category');
    Route::delete('/admin/categories/{id}', [AdminController::class, 'delete_category'])->name('admin.delete_category');

    // Products
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/add', [AdminController::class, 'add_product'])->name('admin.add_product');
    Route::post('/admin/products/store', [AdminController::class, 'store_product'])->name('admin.store_product');
    Route::get('/admin/products/edit/{id}', [AdminController::class, 'edit_product'])->name('admin.edit_product');
    Route::put('/admin/products/update', [AdminController::class, 'update_product'])->name('admin.update_product');
    Route::delete('/admin/products/{id}', [AdminController::class, 'delete_product'])->name('admin.delete_product');
});




