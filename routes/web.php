<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ProfileController::class)->group(function() {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/orders', 'orders')->name('profile.orders');
    });

    Route::controller(CartController::class)->group(function() {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/add/{car}', 'add')->name('cart.add');
        Route::delete('/cart/clear', 'clear')->name('cart.clear');
    });

    Route::controller(FavoriteController::class)->group(function() {
        Route::get('/favorites', 'index')->name('favorite.index');
        Route::post('/favorite/car/{id}/store', 'store')->name('favorite.store');
        Route::delete('/favorites/clear', 'clear')->name('favorite.clear');
    }); 

    Route::controller(OrderController::class)->group(function() {
        Route::post('/order/store', 'store')->name('order.store');
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
        Route::controller(OrderController::class)->group(function() {
            Route::patch('/order/{id}/confirm', 'confirm')->name('order.confirm');
            Route::patch('/order/{id}/complete', 'complete')->name('order.complete');
            Route::patch('/order/{id}/cancel', 'cancel')->name('order.cancel');
            Route::patch('/order/{id}/pending', 'pending')->name('order.pending');
        }); 
    });
});

require __DIR__.'/auth.php';
