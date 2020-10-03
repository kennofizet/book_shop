<?php

use Illuminate\Support\Facades\Route;

/* |--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------- |
| Here is where you can register web routes for your application. These |
routes are loaded by the RouteServiceProvider within a group which | contains
the "web" middleware group. Now create something great! | */ // route index
Route::get('/','HomeController@index')->name('home');
Route::get('/404','HomeController@notFound')->name('notfound');
Route::get('/contact','HomeController@getContact')->name('contact');
Route::get('/about','HomeController@getAbout')->name('about');
Route::get('/category/{slug_category}','HomeController@getListProductByCategory')->name('product-by-category');
Route::get('/product/detail/{id}','HomeController@getProductDetail')->name('product-detail');
// cart 
Route::get('/cart','HomeController@getCart')->name('cart');
Route::get('/checkout','HomeController@getCheckOut')->name('cart-check-out');
// blog
Route::get('/blog','BlogController@getBlog')->name('blog');
Route::get('/blog-detail/{slug_post}','BlogController@getBlogDetail')->name('blog-detail');


//login
Route::get('login','LoginController@index')->name('login');
// group admin


Route::group(['middleware' => 'adminOnly','namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin_slug'], function()  
{  
	Route::get('/','AdminController@index')->name('home');
	Route::group(['as' => 'blog.', 'prefix' => 'blog'], function()  
	{
		Route::get('/list','BlogController@getBlogList')->name('list');
		Route::get('/category','BlogController@getBlogCategoryList')->name('category');
		Route::get('/create','BlogController@getBlogCreate')->name('create');
	});
	Route::group(['as' => 'product.', 'prefix' => 'product'], function()  
	{
		Route::get('/list','ProductController@getProductList')->name('list');
		Route::get('/category','ProductController@getProductCategoryList')->name('category');
		Route::get('/create','ProductController@getProductCreate')->name('create');
	});
	Route::group(['as' => 'cart.', 'prefix' => 'cart'], function()  
	{
		Route::get('/list','CartController@getCartList')->name('list');
		Route::get('/list-customer','CartController@getCartListCustomer')->name('list-customer');
	});
});