<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'shop')->name('home');
});
Route::controller(CarController::class)->group(function() {
    Route::get('/car/{id}', 'show')->name('car.show');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(CartController::class)->group(function() {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/add/{car}', 'add')->name('cart.add');
    });
    // Route::middleware(isAdmin::class)->group(function() {
    //     Route::controller(AdminController)
    // });
    Route::middleware(isAdmin::class)->group(function() {
        Route::controller(AdminController::class)->group(function() {
            Route::get('/admin', 'index')->name('admin.index');
        });
        Route::controller(BrandController::class)->group(function() {
            Route::post('/brand/store', 'store')->name('brand.store');
        });
        Route::controller(CarController::class)->group(function() {
            Route::post('/car/store', 'store')->name('car.store');
        });
    });
});

require __DIR__.'/auth.php';
