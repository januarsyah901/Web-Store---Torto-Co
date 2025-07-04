<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');

Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth',AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brands/add', [AdminController::class, 'add_brand'])->name('admin.add_brand');
    Route::post('/admin/brands/store', [AdminController::class, 'store_brand'])->name('admin.store_brand');
    Route::get('/admin/brands/edit/{id}', [AdminController::class, 'edit_brand'])->name('admin.edit_brand');
    Route::put('/admin/brands/update', [AdminController::class, 'update_brand'])->name('admin.update_brand');
    Route::delete('/admin/brands/{id}', [AdminController::class, 'delete_brand'])->name('admin.delete_brand');
});




