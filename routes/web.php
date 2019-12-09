<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', 'WelcomeController@index');

Route::get('/', function () {
    return view('greet');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/place-order', 'HomeController@processOrder')->name('placeOrder');
Route::get('/confirm-payment/{txref}', 'HomeController@confirmOrder')->name('confirmOrder');
Route::get('/confirm-order-payment/{txref}/{product_id}', 'HomeController@confirmOrderPayment')->name('confirmOrderPayment');
Route::post('/add-to-cart', 'CartController@addToCart')->name('addToCart');
Route::post('/show-to-cart', 'CartController@showtocart')->name('showtocart');
Route::get('/cart', 'CartController@showCart')->name('showCart');
Route::get('/checkout', 'CartController@checkout')->name('checkout');
Route::get('/order/{id}', 'CartController@showOrderDetails')->name('orderDetails');
Route::get('/delete/{id}', 'CartController@deleteOrder')->name('deleteOrder');
Route::get('/restaurant/{id}', 'WelcomeController@showShop')->name('showShop');

Route::prefix('/office/admin')->group(function () {

});

Route::get('admin/login', 'AdminLoginController@showLoginForm');
Route::post('admin/login', 'AdminLoginController@login')->name('admin.login');
Route::get('admin/register', 'AdminRegisterController@showRegisterForm');
Route::post('admin/register', 'AdminRegisterController@register')->name('admin.register');

Route::group(['prefix' => 'admin','middleware' => 'assign.guard:admin,admin/login'],function(){

    Route::get('/home', 'AdminController@index')->name('admin.home');
    Route::put('/confirm-delivery', 'AdminController@confirmProduct')->name('confirmDelivery');
    Route::get('/product/{id}', 'AdminController@showOrderDetails')->name('productDetails');
    Route::get('/restaurant/{id}', 'AdminController@showVendorDetails')->name('vendorDetails');
    Route::put('/confirm-vendor/{id}', 'AdminController@confirmVendor')->name('confirmVendor');
});

Route::get('vendor/login', 'VendorLoginController@showLoginForm');
Route::post('vendor/login', 'VendorLoginController@login')->name('vendor.login');
Route::get('vendor/register', 'VendorRegisterController@showRegisterForm');
Route::post('vendor/register', 'VendorRegisterController@register')->name('vendor.register');

Route::group(['prefix' => 'vendor','middleware' => 'auth:vendor'],function(){

    Route::get('/home', 'VendorController@index')->name('vendor.home');
    Route::get('/add-product', 'VendorController@addProduct')->name('addProduct');
    Route::post('store-product', 'VendorController@saveProduct')->name('saveProduct');
    Route::put('/product/{id}', 'VendorController@updateProduct')->name('updateProduct');
    Route::get('{id}/edit', 'VendorController@editProduct')->name('editProduct');
    
});
