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

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::group(['namespace'=>'Frontend'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('category/{link}', 'CategoryController@index')->name('category');
    Route::get('product/{link}', 'ProductController@index')->name('product');
    Route::get('search', 'ProductController@search')->name('search');
    Route::get('post/{link}', 'PostController@index')->name('post');
    Route::get('page/{link}', 'PageController@index')->name('page');


    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('cart', 'OrderController@cart')->name('cart');
        Route::get('checkout', 'OrderController@checkout')->name('checkout');
        Route::post('checkout', 'OrderController@doCheckout');
        Route::get('success-order/{code}', 'OrderController@successOrder')->name('success-order');
        Route::post('delete-product', 'OrderController@deleteProduct')->name('delete-product');
        Route::post('change-quantity', 'OrderController@changeQuantity')->name('change-quantity');
        Route::post('add-to-cart', 'OrderController@addToCart')->name('add-to-cart');
        Route::post('order-fast-purchase', 'OrderController@orderFastPurchase')->name('order-fast-purchase');
    });
});

Route::group(['namespace'=>'Auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('login', ['uses' => 'LoginController@login'])->name('login');
        Route::post('login', ['uses' => 'LoginController@postLogin']);
        Route::get('logout', ['uses' => 'LoginController@logoutUser'])->name('logout');
    });
});

Route::group(['namespace'=> 'Backend', 'middleware' =>['auth']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'HomeController@index')->name('home.index');

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', 'SettingController@index')->name('index');
            Route::post('update', 'SettingController@update')->name('update');
        });

        Route::get('/delete/image/{row}', 'SettingController@deleteImage')->name('delete.image');

        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::post('/profile', 'UserController@updateProfile');

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/create', 'CategoryController@create')->name('create');
            Route::post('/create', 'CategoryController@store');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
            Route::post('/edit/{id}', 'CategoryController@update');
            Route::get('/delete/{id}', 'CategoryController@destroy')->name('delete');
            Route::get('/restore/{id}', 'CategoryController@restore')->name('restore');
        });

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', 'ProductController@index')->name('index');
            Route::get('/create', 'ProductController@create')->name('create');
            Route::post('/create', 'ProductController@store');
            Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
            Route::post('/edit/{id}', 'ProductController@update');
            Route::get('/delete/{id}', 'ProductController@destroy')->name('delete');
            Route::get('/restore/{id}', 'ProductController@restore')->name('restore');
            Route::get('/search', 'ProductController@search')->name('search');
            Route::post('/get-data-product', 'ProductController@getDataProduct')->name('get-data-product');
            Route::post('/add-image', 'ProductController@addImage')->name('add-image');
        });

        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('/', 'PostController@index')->name('index');
            Route::get('/create', 'PostController@create')->name('create');
            Route::post('/create', 'PostController@store');
            Route::get('/edit/{id}', 'PostController@edit')->name('edit');
            Route::post('/edit/{id}', 'PostController@update');
            Route::get('/delete/{id}', 'PostController@destroy')->name('delete');
            Route::get('/restore/{id}', 'PostController@restore')->name('restore');
        });

        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/', 'PageController@index')->name('index');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/create', 'PageController@store');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::post('/edit/{id}', 'PageController@update');
            Route::get('/delete/{id}', 'PageController@destroy')->name('delete');
            Route::get('/restore/{id}', 'PageController@restore')->name('restore');
        });

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/create', 'UserController@store');
            Route::get('/edit/{id}', 'UserController@edit')->name('edit');
            Route::post('/edit/{id}', 'UserController@update');
            Route::get('/delete/{id}', 'UserController@destroy')->name('delete');
            Route::get('/restore/{id}', 'UserController@restore')->name('restore');
        });

        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', 'OrderController@index')->name('index');
            Route::get('/create', 'OrderController@create')->name('create');
            Route::post('/create', 'OrderController@store');
            Route::get('/edit/{id}', 'OrderController@edit')->name('edit');
            Route::post('/edit/{id}', 'OrderController@update');
            Route::get('/delete/{id}', 'OrderController@destroy')->name('delete');
            Route::get('/complete/{id}', 'OrderController@complete')->name('complete');
            Route::post('/get-data-order', 'OrderController@getDataOrder')->name('get-data-order');
        });

        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('search', 'CustomerController@search')->name('search');
        });

        Route::prefix('banners')->name('banners.')->group(function () {
            Route::get('/', 'BannerController@index')->name('index');
            Route::get('/create', 'BannerController@create')->name('create');
            Route::post('/create', 'BannerController@store');
            Route::get('/edit/{id}', 'BannerController@edit')->name('edit');
            Route::post('/edit/{id}', 'BannerController@update');
            Route::get('/delete/{id}', 'BannerController@destroy')->name('delete');
            Route::get('/restore/{id}', 'BannerController@restore')->name('restore');
        });

        Route::prefix('menus')->name('menus.')->group(function () {
            Route::get('/', 'MenuController@index')->name('index');
            Route::get('/create', 'MenuController@create')->name('create');
            Route::post('/create', 'MenuController@store');
            Route::get('/edit/{id}', 'MenuController@edit')->name('edit');
            Route::post('/edit/{id}', 'MenuController@update');
            Route::get('/delete/{id}', 'MenuController@destroy')->name('delete');
            Route::get('/saveMenu', 'MenuController@saveMenu')->name('saveMenu');
        });
    });
});
