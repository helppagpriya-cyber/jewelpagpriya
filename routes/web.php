<?php

use App\Http\Controller\PaymentController as ControllerPaymentController;
use App\Http\Controllers\PaymentController;
use App\Livewire\AllProductsPage;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Categoriespage;
use App\Livewire\Vendor\ProductList;
use App\Livewire\Vendor\Cart;
use App\Livewire\Vendor\OrderList;
use App\Livewire\CheckoutPayment;
use App\Livewire\Filter;
use App\Livewire\IndexPage;
use App\Livewire\PolicyPage;
use App\Livewire\Product;
use App\Livewire\Reviews;
use App\Livewire\Search;
use App\Livewire\Category;
use App\Livewire\Categorypage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route as RouteFacade;


Route::get('/', IndexPage::class)->name('home');
Route::get('search', Search::class,)->name('search');
Route::get('product/{productId}', ProductDetailPage::class)->name('product');
Route::get('/all-products', AllProductsPage::class)->name('allProducts');
Route::get('categories', Categoriespage::class)->name('categories');
Route::get('subcategory/{category}', Categorypage::class)->name('category');
Route::get('review/{product_id}', Reviews::class)->name('review')->middleware('userAuth');

Route::get('/payment/{productId}', CheckoutPayment::class)->name('checkout.payment')->middleware('userAuth');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');


Route::get('/vendorproducts', ProductList::class)->name('vendor.products')->middleware('auth');
Route::get('/vendorcart', Cart::class)->name('vendor.vendorcart')->middleware('auth');
Route::get('/vendororders', OrderList::class)->name('vendor.orders')->middleware('auth');





Route::get('/checkout/callback', [PaymentController::class, 'handleCallback'])
    ->name('checkout.callback')->middleware('auth');
Route::get('/orders', function () {
    return view('orders-index');
})->name('orders-index');
Route::get('/policy', PolicyPage::class)->name('policy.show');

Route::controller(\App\Http\Controllers\IndexController::class)->group(function () {
    Route::get('women', 'women');
    Route::get('men', 'men');
    Route::get('products/{category}', 'products');
    Route::get('productsize/{product_id}/{size_name}', 'getPrice');

    Route::get('wishlist/{product_id}', 'wishlist')->middleware('userAuth');
    Route::get('cart/remove/{product_id}', 'cartRemove')->middleware('userAuth');
    Route::get('shop-now/{product}', 'shopNow')->middleware('userAuth');
    Route::post('shopNow', 'shopProduct')->middleware('userAuth');
    Route::get('shop-all', 'shopAllView')->middleware('userAuth');
    Route::post('shopAll', 'shopAll')->middleware('userAuth');
    Route::get('profile', 'profile')->middleware('userAuth');

    Route::get('addReview', 'addReview')->middleware('userAuth');

    Route::get('pdf/{order}', 'downloadOrderInvoicePdf')->middleware('userAuth');
});
