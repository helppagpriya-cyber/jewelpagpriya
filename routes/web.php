<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::controller(\App\Http\Controllers\IndexController::class)->group(function(){
    Route::get('/','index');
    Route::get('all-products','allProducts');
    Route::get('women','women');
    Route::get('men','men');
    Route::get('categories','categories');
    Route::get('subcategory/{category}','category');
    Route::get('products/{category}','products');
    Route::get('product/{product_id}','product');
    Route::get('productsize/{product_id}/{size_name}', 'getPrice');
    Route::get('search', 'search');

    Route::get('wishlist/{product_id}','wishlist')->middleware('userAuth');
    Route::get('cart/remove/{product_id}','cartRemove')->middleware('userAuth');
    Route::get('shop-now/{product}','shopNow')->middleware('userAuth');
    Route::post('shopNow','shopProduct')->middleware('userAuth');
    Route::get('shop-all','shopAllView')->middleware('userAuth');
    Route::post('shopAll','shopAll')->middleware('userAuth');
    Route::get('profile','profile')->middleware('userAuth');
    Route::get('review/{product_id}','review')->middleware('userAuth');
    Route::get('addReview','addReview')->middleware('userAuth');

    Route::get('pdf/{order}','downloadOrderInvoicePdf')->middleware('userAuth');
});
