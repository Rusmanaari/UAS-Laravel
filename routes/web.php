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



Route::get('/', 'ProductController@index')->name('products.index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/images/{filename}');
// user Routes
Route::name('user.')->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::resource('products', 'user\ProductController');
        Route::get('/products/image/{imageName}', 'user\ProductController@image')->name('products.image');
        Route::resource('orders','user\OrderController');
    });
});
Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::post('/products/review', 'ReviewController@store')->name('review.store');
Route::get('/products/image/{imageName}', 'ProductController@image')->name('products.image');

Route::get('/carts', 'CartController@index')->name('carts.index');
Route::get('/carts/add{id}', 'CartController@add')->name('carts.add');
Route::patch('carts/update', 'CartController@update')->name('carts.update');
Route::delete('carts/remove', 'CartController@remove')->name('carts.remove');


//admin
Route::match(['get','post'],'/admin', 'AdminController@login'); //submit our form for login process
Route::get('/admin','AdminController@index');
Route::group(['middleware' => ['auth']],function(){
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/settings', 'AdminController@settings');
Route::get('/admin/check-pwd', 'AdminController@chkpassword');
Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
// Categories Routes (Admin)
Route::match(['get','post'],'/admin/add-category', 'CategoryController@addCategory');
Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
Route::get('/admin/view-categories', 'CategoryController@viewCategories');

//Products Routes (Admin)
Route::match(['get','post'],'/admin/add-product', 'ProductsController@addProduct');
Route::match(['get','post'],'/admin/edit-product/{id}', 'ProductsController@editProduct');
Route::get('/admin/view-products','ProductsController@viewProducts');
Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');
Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');

//products attributes routes (Admin)
Route::match(['get','post'],'/admin/add-attributes/{id}', 'ProductsController@addAttributes');
Route::match(['get','post'],'/admin/edit-attributes/{id}', 'ProductsController@editAttributes');
Route::match(['get','post'],'/admin/add-images/{id}', 'ProductsController@addImages');
Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteAttribute');

//Coupons Route
Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
Route::get('/admin/view-coupons', 'CouponsController@viewCoupons');
Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

//Admin Orders Route
Route::get('/admin/view-orders', 'ProductsController@viewOrders');

//Admin Order Detail Page
Route::get('/admin/view-order/{id}', 'ProductsController@viewOrderDetails');

//Update Order Status
Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');
});
Route::get('/logout', 'AdminController@logout');

Route::get('/admin/order/','ProductController@index')->name('admin.orders.create');
