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
//homepage
Route::get('/','IndexController@index');

//category page
Route::get('/products/{url}','ProductController@products');

//product details page
Route::get('/product/{id}','ProductController@product');

Route::get('/get_product_price','ProductController@get_product_price');

//cart
Route::match(['get','post'],'/add_cart','ProductController@add_cart');
Route::match(['get','post'],'/cart','ProductController@cart');
Route::get('/cart/delete_cart_product/{id}','ProductController@delete_cart_product');

Route::get('/cart/update_quantity/{id}/{quantity}','ProductController@update_cart_quantity');

//user redister
Route::match(['get','post'],'/check_email','UserController@check_email');
//for fetching login -register page
Route::get('/login_register','UserController@userLoginRegister');
//for registering a user
Route::post('/user_register','UserController@register');	    //uesr register
Route::get('/user_logout','UserController@user_logout');       //logout
//for login
Route::post('/user_login','UserController@user_login');



//coupon apply
Route::post('/cart/apply_coupon','ProductController@apply_coupon');

//admin login
Route::match(['get','post'],'/admin','AdminController@login');

Route::group(['middleware'=>['frontlogin']],function(){
	//for account
	Route::match(['get','post'],'/account','UserController@account');
	Route::post('/update_user_pwd','UserController@update_user_pwd');
	//Route::post('post','/update_user_pwd','UserController@update_user_pwd');
	//for checkout page
	Route::match(['get','post'],'/checkout','ProductController@checkout');
	//order review
	Route::match(['get','post'],'/order_review','ProductController@order_review');
	//for placing an order
	Route::match(['get','post'],'/place_order','ProductController@place_order');
	//thanks page
	Route::get('/thanks','ProductController@thanks');
	//thanks paypal
	Route::get('/thanks_paypal','ProductController@thanks_paypal');
	//paypal cancel
	Route::get('/paypal_cancel','ProductController@paypal_cancel');
	//users order show
	Route::get('/orders','ProductController@user_orders');
	//user ordered products
	Route::get('/orders/{id}','ProductController@user_order_details');
	//paypal checkout
	Route::get('/paypal','ProductController@paypal');
});

Route::group(['middleware'=>['auth']],function(){
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check_pwd','AdminController@chkPassword');
	Route::match(['get','post'],'/admin/update_pwd','AdminController@updatePassword');

	//category routes (admin)
	Route::match(['get','post'],'/admin/add_category','CategoryController@addCategory');
	Route::get('/admin/view_categories','CategoryController@view_categories');
	Route::match(['get','post'],'admin/edit_categories/{id}','CategoryController@adit_categories');
	Route::match(['get','post'],'admin/delete_categories/{id}','CategoryController@delete_categories');
	//products routes (admin)
	Route::match(['get','post'],'/admin/add_products','ProductController@add_products');
	Route::get('admin/view_products','ProductController@view_products');
	Route::match(['get','post'],'/admin/edit_products/{id}','ProductController@edit_products');
	Route::get('/admin/delete_product_images/{id}','ProductController@delete_product_images');
	Route::get('/admin/delete_products/{id}','ProductController@delete_products');

	//products attributes
	Route::match(['get','post'],'admin/add_attributes/{id}','ProductController@add_attributes');
	Route::get('/admin/delete_attribute/{id}','ProductController@delete_attribute');
	Route::match(['get','post'],'/admin/edit_attributes/{id}','ProductController@edit_attributes');

	//for adding product images
	Route::match(['get','post'],'admin/add_images/{id}','ProductController@add_images');
	Route::get('/admin/delete_alternate_images/{id}','ProductController@delete_alternate_images');

	//for adding coupon
	Route::match(['get','post'],'/admin/add_coupon','CouponsController@add_coupon');
	Route::get('/admin/view_coupon','CouponsController@view_coupon');
	Route::match(['get','post'],'/admin/edit_coupons/{id}','CouponsController@edit_coupons');
	Route::get('/admin/delete_coupons/{id}','CouponsController@delete_coupons');

	//for banners
	Route::match(['get','post'],'/admin/add_banner','BannersController@add_banner');
	Route::get('admin/view_banner','BannersController@view_banner');
	Route::match(['get','post'],'/admin/edit_banner/{id}','BannersController@edit_banner');
	Route::get('/admin/delete_banner/{id}','BannersController@delete_banner');
	
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout','AdminController@logout');
