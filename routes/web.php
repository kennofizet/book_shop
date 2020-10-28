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
Route::middleware(['userCli'])->group(function () {
	Route::get('/contact','HomeController@getContact')->name('contact');
});
Route::get('/about','HomeController@getAbout')->name('about');
Route::get('/category/{slug_category}','HomeController@getListProductByCategory')->name('product-by-category');
Route::get('/product/detail/{id}','HomeController@getProductDetail')->name('product-detail');
// cart 
Route::get('/search/{key}','HomeController@getSearch')->name('search');
Route::post('/search-pro-post','HomeController@postSearch')->name('search-pro-post');

Route::get('/cart','HomeController@getCart')->name('cart');
Route::get('/checkout','HomeController@getCheckOut')->name('cart-check-out');
// blog
Route::get('/blog','BlogController@getBlog')->name('blog');
Route::get('/blog-detail/{slug_post}','BlogController@getBlogDetail')->name('blog-detail');


// mix login
Route::get('login','LoginController@getLogin')
->name('login_admin');
Route::get('OAuth/login','LoginController@getLoginOAuth')
->name('login');
Route::post('login','LoginController@postLogin')
->name('post_login');
// route logut
Route::get('logout','LoginController@Logout')->name('logout');
//route signup
Route::post('signup', 'LoginController@postSignUp')
->name('post_register');
//route remember
Route::get('remember', 'LoginController@getRemember');
Route::post('remember', 'LoginController@postRemember')
->name('post_forgot_password');
//route verify
Route::get('verify/{email}/{confirmation_code}', 'LoginController@Verify')
->name('verify');

Route::group(['namespace' => 'Api\V1\DefaultMaganer'], function () {
	Route::get('verify/api/confirm-api-looking-view-page-email/{id}/{confirmation_code}', 'LinkController@getConfirmCodeEmailApiLookingViewPage');
	Route::get('verify/api/confirm-api-email-email/{id}/{confirmation_code}', 'LinkController@getConfirmCodeEmailApiEmail');
});
//route reset password
Route::get('reset-password/{email}/{confirmation_code}', 'LoginController@resetPassword');
Route::post('reset-password', 'LoginController@sendResetPassword')





->name('resetpassword');
// group admin


Route::group(['middleware' => 'adminOnly','namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin_slug'], function()  
{  
	Route::get('/','AdminController@index')->name('home');
	Route::group(['as' => 'my-account.', 'prefix' => 'my-account'], function()  
	{ 
		Route::get('/','AccountController@myAcccount')->name('info');
		Route::get('/change-password','AccountController@myAcccountChangePassword')->name('change-password');
	});
	Route::group(['as' => 'account.', 'prefix' => 'account'], function()  
	{ 
		Route::get('/','AccountController@listAccount')->name('list');
		Route::get('/active','AccountController@listAccountActive')->name('list-active');
		Route::get('/wait','AccountController@listAccountWait')->name('list-wait');
		Route::post('/search','AccountController@postSearchAccount')->name('search');
		Route::get('/search',function (){
			return redirect(route('admin.product.list'));
		});
	});
	
	Route::get('/404-page','AdminController@notFound')->name('notfound');
	Route::group(['as' => 'blog.', 'prefix' => 'blog'], function()  
	{
		Route::get('/list','BlogController@getBlogList')->name('list');
		Route::get('/list/active','BlogController@getBlogListActive')->name('list-active');
		Route::get('/list/hidden','BlogController@getBlogListHidden')->name('list-hidden');
		Route::get('/category','BlogController@getBlogCategoryList')->name('category');
		Route::get('/create','BlogController@getBlogCreate')->name('create');
		Route::get('/edit/{id}','BlogController@getEditPost')->name('edit-post');
	});
	Route::group(['as' => 'product.', 'prefix' => 'product'], function()  
	{
		Route::get('/list','ProductController@getProductList')->name('list');
		Route::get('/list-active','ProductController@getProductListActive')->name('list-active');
		Route::get('/list-hidden','ProductController@getProductListHidden')->name('list-hidden');
		Route::get('/category','ProductController@getProductCategoryList')->name('category');
		Route::get('/create-category','ProductController@getProductCategoryCreate')->name('create-category');
		Route::get('/edit-category/{id}','ProductController@getProductCategoryEdit')->name('edit-category');
		Route::get('/edit/{id}','ProductController@getProductEdit')->name('edit');
		Route::get('/create','ProductController@getProductCreate')->name('create');
		Route::post('/search','ProductController@postSearchProduct')->name('search');
		Route::get('/search',function (){
			return redirect(route('admin.product.list'));
		});
		Route::group(['as' => 'type.', 'prefix' => 'type'], function()  
		{
			Route::get('/list','ProductController@getProductTypeList')->name('list');
			Route::get('/create','ProductController@getProductTypeCreate')->name('create');
			Route::post('/search','ProductController@postSearchProductType')->name('search');
			Route::get('/search',function (){
				return redirect(route('admin.product.type.list'));
			});
		});
	});
	Route::group(['as' => 'cart.', 'prefix' => 'cart'], function()  
	{
		Route::get('/list','CartController@getCartList')->name('list');
		Route::get('/list/{id}','CartController@getCartListDetail')->name('list-detail');
		Route::get('/list-customer','CartController@getCartListCustomer')->name('list-customer');
		Route::get('/list-customer/{id}','CartController@getCartCustomerById')->name('customer-by-id');

		Route::post('/search-customer','CartController@postSearchCartCustomer')->name('search-customer');
		Route::get('/search-customer',function (){
			return redirect(route('admin.cart.list-customer'));
		});

		Route::post('/search','CartController@postSearchCart')->name('search');
		Route::get('/search',function (){
			return redirect(route('admin.cart.list-customer'));
		});
	});
	Route::group(['as' => 'setting.', 'prefix' => 'setting'], function()  
	{
		Route::group(['as' => 'template.', 'prefix' => 'template'], function()  
		{
			Route::get('/login','SettingController@getSettingLogin')->name('login');
			Route::get('/add-login','SettingController@getSettingAddLogin')->name('add-login');
			Route::get('/login/active','SettingController@getSettingLoginActive')->name('login-active');
			Route::get('/login/un-active','SettingController@getSettingLoginUnActive')->name('login-un-active');
		});
	});
	Route::group(['as' => 'preview.', 'prefix' => 'preview'], function()  
	{
		Route::group(['as' => 'setting.', 'prefix' => 'setting'], function()  
		{
			Route::get('/add-login','PreviewController@getPreviewAddLogin')->name('add-login');
		});
	});
});















// route post admin
Route::group(['middleware' => 'adminOnly','namespace' => 'Source\Api\Admin', 'as' => 'source.api.admin.', 'prefix' => 'source/api/admin'], function()  
{
	Route::group(['as' => 'account.', 'prefix' => 'account'], function()  
	{
		Route::group(['as' => 'my-account.', 'prefix' => 'my-account'], function()  
		{
			Route::post('/update','AccountController@postUpdateMyAccount')->name('update');
			Route::post('/change-password','AccountController@postChangePasswordMyAccount')->name('change-password');
		});
		Route::post('/lock','AccountController@postLockAccount')->name('lock');
		Route::post('/unlock','AccountController@postUnLockAccount')->name('unlock');
		Route::post('/delete','AccountController@postDeleteAccount')->name('delete');
	});
	Route::group(['as' => 'setting.', 'prefix' => 'setting'], function()  
	{
		Route::group(['as' => 'template.', 'prefix' => 'template'], function()  
		{
			Route::post('/add-login','SettingController@postSettingAddLogin')->name('add-login');
			Route::post('/edit-login','SettingController@postSettingEditLogin')->name('edit-login');
			Route::post('/setting-count-data-page-login','SettingController@postSettingCountDataPageLogin')->name('setting-count-data-page-login');
		});
	});
	Route::group(['as' => 'blog.', 'prefix' => 'blog'], function()  
	{
		Route::post('/add-post','BlogController@postAddPost')->name('add-post');
		Route::post('/setting-count-data-page-blog','BlogController@postSettingCountDataPageBlog')->name('setting-count-data-page-blog');
		Route::post('/delete','BlogController@postDeletePost')->name('delete-post');
		Route::post('/edit','BlogController@postEditPost')->name('edit-post');
	});
	Route::group(['as' => 'cart.', 'prefix' => 'cart'], function()  
	{
		Route::post('/update-bill-status','CartController@postUpdateBillStatusCart')->name('update-bill-status');
	});
	Route::group(['as' => 'product.', 'prefix' => 'product'], function()  
	{
		Route::post('/create','ProductController@postCreateProduct')->name('create');
		Route::post('/edit','ProductController@postEditProduct')->name('edit');
		Route::post('/delete','ProductController@postDeleteProduct')->name('delete');
		Route::post('/setting-count-data-page-product','ProductController@postSettingCountDataPageProduct')->name('setting-count-data-page-product');
		Route::post('/setting-category-data-page-product','ProductController@postSettingCategoryDataPageProduct')->name('setting-category-data-page-product');
		Route::group(['as' => 'category.', 'prefix' => 'category'], function()  
		{
			Route::post('/create','ProductController@postCreateProductCategory')->name('create');
			Route::post('/delete','ProductController@postProductCategoryDeleteById')->name('delete');
			Route::post('/edit','ProductController@postEditProductCategory')->name('edit');
		});
		Route::group(['as' => 'sale.', 'prefix' => 'sale'], function()  
		{
			Route::post('/new','ProductController@postNewProductSale')->name('new');
			Route::post('/un','ProductController@postUnProductSale')->name('un');
		});
		Route::group(['as' => 'store.', 'prefix' => 'store'], function()  
		{
			Route::post('/non','ProductController@postNonProductStore')->name('non');
			Route::post('/has','ProductController@postHasProductStore')->name('has');
		});
		Route::group(['as' => 'type.', 'prefix' => 'type'], function()  
		{
			Route::post('/create','ProductController@postProductTypeCreate')->name('create');
			Route::post('/delete','ProductController@postProductTypeDeleteById')->name('delete');
			Route::post('/setting-count-data-page-product-type','ProductController@postSettingTypeDataPageProduct')->name('setting-count-data-page-product-type');
		});
	});
});
Route::group(['middleware' => 'userCli','namespace' => 'Source\Api', 'as' => 'source.api.user.', 'prefix' => 'source/api/user'], function()  
{
	Route::group(['as' => 'contact.', 'prefix' => 'contact'], function()  
	{
		Route::post('/send-new','ContactController@postSendNewContact')->name('send-new');
	});
	Route::group(['as' => 'blog.', 'prefix' => 'blog'], function()  
	{
		Route::post('/like-post','BlogController@postLikePost')->name('like-post');
	});
	Route::group(['as' => 'product.', 'prefix' => 'product'], function()  
	{
		Route::post('/sort-product-category','ProductController@postSortProductCategory')->name('sort-product-category');
	});
});
Route::group(['namespace' => 'Source\Api', 'as' => 'source.api.user.', 'prefix' => 'source/api/user'], function()  
{
	Route::group(['as' => 'product.', 'prefix' => 'product'], function()  
	{
		Route::post('/sort-price-product-category','ProductController@postSortPriceProductCategory')->name('sort-price-product-category');
	});
	Route::group(['as' => 'cart.', 'prefix' => 'cart'], function()  
	{
		Route::post('/cart-check-out','CartController@postCartCheckOut')->name('cart-check-out');
		Route::post('/add-to-cart','CartController@postAddtoCart')->name('add-to-cart');
		Route::post('/add-to-cart-multi','CartController@postAddtoCartMulti')->name('add-to-cart-multi');
		Route::post('/update-to-cart-single','CartController@postUpdateToCartSingle')->name('update-to-cart-single');
		Route::post('/delete-cart-item','CartController@postDeleteCartItem')->name('delete-cart-item');
		Route::post('/count-item-cart','CartController@postCountItemCart')->name('count-item-cart');
	});
});
