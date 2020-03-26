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

/*Route::get('/', function () {
    return view('frontend.main');
});*/
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});



/* Route::resource('post', 'FrontController'); */

/* admin */
Route::get('/admin', 'admin\AdminController@index');

/* slider */
Route::resource('slider', 'admin\SliderController');

/* categories */
Route::resource('category', 'admin\CategoryController');

/* auth */
Auth::routes();

/* users */
Route::resource('users', 'admin\UsersController');

/* products */
Route::resource('products', 'admin\ProductsController');

/* product images*/
Route::resource('images', 'admin\ImagesController');
Route::post('/remove_image_backend', 'admin\ImagesController@destroy');

/* stoc */
Route::resource('stocs', 'admin\StocsController');


/*------------------------*/
/* frontend */
Route::get('/', 'FrontController@index')->name('site');
Route::get('/home', 'FrontController@index')->name('home');

Route::get('/contact', 'FrontController@contact')->name('contact');
Route::get('/account', 'FrontController@accountLogin');
Route::get('/addUser', 'FrontController@createAccount');

Route::post('/register', 'FrontController@register');
Route::post('/sendMessage', 'FrontController@sendMessage');

Route::get('displayCategory/{id}', 'FrontController@showCategoryProducts');
Route::post('/filterProducts', 'FrontController@filterProducts');
Route::get('/showProduct/{id}', 'FrontController@showProduct');

Route::post('/add_to_cart', 'CartController@addToCart');
Route::post('/remove_from_cart', 'CartController@removeFromCart');
Route::get('/shop', 'CartController@showCart');
Route::post('/updateCart', 'CartController@updateCart');
Route::get('/checkoutCart', 'CartController@checkout');
Route::post('/submitOrder', 'CartController@completeOrder');

Route::post('/changeRegion', 'CountryRegionCity@getCity');
Route::post('/changeCountry', 'CountryRegionCity@getRegion');

Route::get('/showOrder', 'OrderController@getUserOrders');
Route::post('/user_order_details', 'OrderController@getUserOrderDetails');


/* get the query after execution */
/*Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
    var_dump($query);
    echo'<pre>';
    var_dump($query->sql);
    var_dump($query->bindings);
    var_dump($query->time);
    echo'</pre>';
});*/