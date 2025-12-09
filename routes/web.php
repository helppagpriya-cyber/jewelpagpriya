<?php

use App\Http\Controllers\PaymentController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Vendor\ProductList;
use App\Livewire\Vendor\Cart;
use App\Livewire\Vendor\OrderList;
use App\Livewire\CheckoutPayment;
use App\Livewire\PolicyPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route as RouteFacade;


Route::get('/vendorproducts', ProductList::class)->name('vendor.products')->middleware('auth');
Route::get('/vendorcart', Cart::class)->name('vendor.cart')->middleware('auth');
Route::get('/vendororders', OrderList::class)->name('vendor.orders')->middleware('auth');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
Route::get('/', \App\Livewire\IndexPage::class)->name('home');

Route::get('/payment/{order}', CheckoutPayment::class)
    ->name('checkout.payment')
    ->middleware('auth');
Route::post('/checkout/callback', [PaymentController::class, 'handleCallback'])
    ->name('checkout.callback')->middleware('auth');
Route::get('/orders', function () {
    return view('orders-index'); // or Livewire component
})->name('orders-index');
Auth::routes();
Route::get('/policy/{slug}', PolicyPage::class)->name('policy.show');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
Route::get('/', \App\Livewire\IndexPage::class)->name('home');

Route::controller(\App\Http\Controllers\IndexController::class)->group(function () {
    //Route::get('/', 'index');
    Route::get('all-products', 'allProducts');
    Route::get('women', 'women');
    Route::get('men', 'men');
    Route::get('categories', 'categories');
    Route::get('subcategory/{category}', 'category');
    Route::get('products/{category}', 'products');
    Route::get('product/{product_id}', 'product');
    Route::get('productsize/{product_id}/{size_name}', 'getPrice');
    Route::get('search', 'search');

    Route::get('wishlist/{product_id}', 'wishlist')->middleware('userAuth');
    Route::get('cart/remove/{product_id}', 'cartRemove')->middleware('userAuth');
    Route::get('shop-now/{product}', 'shopNow')->middleware('userAuth');
    Route::post('shopNow', 'shopProduct')->middleware('userAuth');
    Route::get('shop-all', 'shopAllView')->middleware('userAuth');
    Route::post('shopAll', 'shopAll')->middleware('userAuth');
    Route::get('profile', 'profile')->middleware('userAuth');
    Route::get('review/{product_id}', 'review')->middleware('userAuth');
    Route::get('addReview', 'addReview')->middleware('userAuth');

    Route::get('pdf/{order}', 'downloadOrderInvoicePdf')->middleware('userAuth');
});
