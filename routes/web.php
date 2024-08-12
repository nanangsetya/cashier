<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('cart');
    }
    return view('auth');
})->name('login');

Route::get('logout', function () {
    auth()->logout();
    return view('auth');
})->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart')->middleware('auth');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('product', function () {
        return view('product');
    })->name('product');

    Route::get('add-product', function () {
        return view('product', ['form' => 'store']);
    })->name('add-product');

    Route::get('edit-product/{id}', function (Request $r) {
        $product = Product::find($r->id);
        if (!$product) {
            return redirect()->back();
        }
        return view('product', ['form' => 'edit', 'product' => $product]);
    })->name('edit-product');
});
