<?php

use Illuminate\Support\Facades\Route;

//Frontend
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/home-page','App\Http\Controllers\HomeController@index');


//Category product
Route::get('/category-product/{category_id}','App\Http\Controllers\HomeController@show_category_product');
//Brand product
Route::get('/brand_product/{brand_id}','App\Http\Controllers\HomeController@show_brand_product');
//Detail Pages
Route::get('/product-detail/{product_id}','App\Http\Controllers\HomeController@show_detail');
//Cart
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');
Route::get('/delete-cart/{rowId}','App\Http\Controllers\CartController@delete_cart');
//Check out
Route::get('/login-checkout','App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::post('/save-shipping','App\Http\Controllers\CheckoutController@save_shipping');
Route::get('/payment','App\Http\Controllers\CheckoutController@payment');
Route::post('/order','App\Http\Controllers\CheckoutController@order');

//Customer
Route::post('/register-customer','App\Http\Controllers\CustomerController@register_customer');
Route::get('/login-page','App\Http\Controllers\CustomerController@login_page');
Route::get('/logout-page','App\Http\Controllers\CustomerController@logout_page');
Route::post('/login-customer','App\Http\Controllers\CustomerController@login_customer');




//Backend
Route::get('/admin-login','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@showDashboard');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@logIn');
Route::get('/log_out','App\Http\Controllers\AdminController@logOut');

//Show front Category Product
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');

//Handling Category Product
Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');

Route::get('/inactive-category-product/{cateProduct_id}','App\Http\Controllers\CategoryProduct@inactive_category_product');
Route::get('/active-category-product/{cateProduct_id}','App\Http\Controllers\CategoryProduct@active_category_product');

Route::get('/edit-category-product/{cateProduct_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::post('/update-category-product/{cateProduct_id}','App\Http\Controllers\CategoryProduct@update_category_product');
Route::get('/delete-category-product/{cateProduct_id}','App\Http\Controllers\CategoryProduct@delete_category_product');

//Show front Category Brand
Route::get('/add-category-brand','App\Http\Controllers\CategoryBrand@add_category_brand');
Route::get('/all-category-brand','App\Http\Controllers\CategoryBrand@all_category_brand');

//Handling Category Brand
Route::post('/save-category-brand','App\Http\Controllers\CategoryBrand@save_category_brand');

Route::get('/inactive-category-brand/{cateBrand_id}','App\Http\Controllers\CategoryBrand@inactive_category_brand');
Route::get('/active-category-brand/{cateBrand_id}','App\Http\Controllers\CategoryBrand@active_category_brand');

Route::get('/edit-category-brand/{cateBrand_id}','App\Http\Controllers\CategoryBrand@edit_category_brand');
Route::post('/update-category-brand/{cateBrand_id}','App\Http\Controllers\CategoryBrand@update_category_brand');
Route::get('/delete-category-brand/{cateBrand_id}','App\Http\Controllers\CategoryBrand@delete_category_brand');

//Show front Product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');

//Handling Product
Route::post('/save-product','App\Http\Controllers\ProductController@save_product');

Route::get('/inactive-product/{product_id}','App\Http\Controllers\ProductController@inactive_product');
Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');

Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');

//Manage Order
Route::get('/manage-order','App\Http\Controllers\ManageOrderController@manage_order');
Route::get('/delete-order/{order_id}','App\Http\Controllers\ManageOrderController@delete_order');
Route::get('/order-details/{order_id}','App\Http\Controllers\ManageOrderController@order_details');
