<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Cart;
use App\Livewire\Categories;
use App\Livewire\Checkout;
use App\Livewire\Home;
use App\Livewire\Orders;
use App\Livewire\ProductDetails;
use App\Livewire\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/categories', Categories::class)->name('categories');
Route::get('/products', Products::class)->name('products');
Route::get('/products/{slug}', ProductDetails::class)->name('product.details');
Route::get('/cart', Cart::class)->name('cart');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('forgot.password');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/orders', Orders::class)->name('orders');
    Route::get('logout', function () {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout');
});
