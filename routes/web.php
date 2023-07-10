<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/test', 'ClientProductController@test');
Auth::routes();

//============================
// CLIENT
//============================
Route::get('/', 'ClientIndexController@index');

//============================
// Product Cat
//============================
Route::get('/san-pham/{slug}','ClientProductCatController@index')->where('slug','.*(?<!html)$');

//============================
// Product
//============================
Route::get('/san-pham/{slug}.html', 'ClientProductController@detail')->name('product.detail');

//============================
// Post
//============================
Route::get('/bai-viet', 'ClientPostController@index')->name('post.index');
Route::get('/bai-viet/{slug}.html', 'ClientPostController@detail')->name('post.detail');

//============================
// Page
//============================
Route::get('/{slug}.html', 'ClientPageController@index')->name('page.index');

//============================
// Cart
//============================
Route::get('cart/', 'ClientCartController@index')->name('cart');
Route::get('cart/add/{slug}', 'ClientCartController@addCart')->name('cart.add');
Route::post('cart/add/{slug}', 'ClientCartController@addCart')->name('cart.add');
Route::get('cart/remove/{rowId}', 'ClientCartController@remove')->name('cart.remove');
Route::get('cart/destroy', 'ClientCartController@destroy');
Route::post('cart/update', 'ClientCartController@update');
Route::post('cart/updateAjax', 'ClientCartController@updateAjax');
Route::get('cart/checkout', 'ClientCartController@checkout')->name('checkout');
Route::get('cart/buynow/{slug}', 'ClientCartController@buynow')->name('buy.now');
Route::post('cart/saveOrder', 'ClientCartController@saveOrder');
//tiny
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    }
    );
//============================
// ADMIN
//============================
Route::middleware('auth')->group(function () {
    

    //Trang chủ
    Route::get('/home', 'HomeController@index')->name('home');

    //============================
    // Dashboard
    //============================
    Route::get('/dashboard', 'DashboardController@show');
    Route::get('/admin', 'DashboardController@show');

    //============================
    // User
    //============================
    Route::get('/admin/user/list', 'AdminUserController@list')->name('user.list');
    Route::get('admin/user/add', 'AdminUserController@add');
    Route::post('admin/user/store', 'AdminUserController@store');
    Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name('delete_user');
    Route::post('admin/user/action', 'AdminUserController@action');
    Route::get('admin/user/edit/{id}', 'AdminUserController@edit')->name('user.edit');
    Route::post('admin/user/update{id}', 'AdminUserController@update')->name('user.update');

    //============================
    // Page
    //============================
    Route::get('/admin/page/list', 'AdminPageController@index');
    Route::get('/admin/page/add', 'AdminPageController@create');
    Route::post('/admin/page/store', 'AdminPageController@store');
    Route::get('/admin/page/edit/{id}', 'AdminPageController@edit')->name('page.edit');
    Route::post('/admin/page/update/{id}', 'AdminPageController@update')->name('page.update');
    Route::get('/admin/page/softDelete/{id}', 'AdminPageController@softDelete')->name('softDelete.page');
    Route::post('admin/page/action', 'AdminPageController@action');

    //============================
    // Post
    //============================
    Route::get('/admin/post/list', 'AdminPostController@index');
    Route::get('/admin/post/add', 'AdminPostController@add');
    Route::post('/admin/post/store', 'AdminPostController@store');
    Route::get('/admin/post/softDelete/{id}', 'AdminPostController@softDelete')->name('post.softDelete');
    Route::post('/admin/post/action', 'AdminPostController@action');
    Route::get('/admin/post/edit/{id}', 'AdminPostController@edit')->name('post.edit');
    Route::post('/admin/post/update/{id}', 'AdminPostController@update')->name('post.update');

    //============================
    // Product Cat 
    //============================
    Route::get('/admin/productcat/list', 'AdminProductCatController@index');
    Route::get('/admin/productcat/add', 'AdminProductCatController@add');
    Route::post('/admin/productcat/create', 'AdminProductCatController@create');
    Route::get('/admin/productcat/softDelete/{id}', 'AdminProductCatController@softDelete')->name('productCat.softDelete');
    Route::post('/admin/productcat/action', 'AdminProductCatController@action');
    Route::get('/admin/productcat/edit/{id}', 'AdminProductCatController@edit')->name('productCat.edit');
    Route::post('/admin/productcat/store/{id}', 'AdminProductCatController@store')->name('productCat.store');

    //============================
    // Product
    //============================
    Route::get('/admin/product/list', 'AdminProductController@index');
    Route::get('/admin/product/add', 'AdminProductController@add');
    Route::post('admin/product/create', 'AdminProductController@create');
    Route::get('admin/product/softDelete/{id}', 'AdminProductController@softDelete')->name('product.softDelete');
    Route::post('admin/product/action', 'AdminProductController@action');
    Route::get('admin/product/edit/{id}', 'AdminProductController@edit')->name('product.edit');
    Route::post('admin/product/update/{id}', 'AdminProductController@update')->name('product.update');

    //============================
    // Order
    //============================
    Route::get('/admin/order/list/', 'AdminOrderController@index');
    Route::get('/admin/order/detailorder/{id}', 'AdminOrderController@detail_order')->name('detail.order');
    Route::get('/admin/order/list/', 'AdminOrderController@index');
    Route::post('/admin/order/update/{id}', 'AdminOrderController@update')->name('update.order');
});