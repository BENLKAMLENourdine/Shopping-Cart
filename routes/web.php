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

Route::get('/', [
    'uses'=> 'ProductController@getProducts',
    'as'=> 'product.index'
]);

Route::get('/add_to_cart/{id}',[
            'uses'=> 'ProductController@addToCart',
            'as'=> 'shop.addToCart'
        ]);

Route::get('/reduce/{id}',[
            'uses'=> 'ProductController@reduce',
            'as'=> 'shop.reduce'
        ]);
Route::get('/remove/{id}',[
            'uses'=> 'ProductController@remove',
            'as'=> 'shop.remove'
        ]);

Route::get('/shopping_cart',[
            'uses'=> 'ProductController@getCart',
            'as'=> 'products.shoppingcart'
        ]);

Route::get('/checkout',[
            'uses'=> 'ProductController@getCheckout',
            'as'=> 'checkout',
            'middleware' => 'auth'
        ]);

Route::post('/checkout',[
            'uses'=> 'ProductController@postCheckout',
            'as'=> 'checkout',
            'middleware' => 'auth'
        ]);

Route::group(['prefix' => '/user'],function(){
    Route::group(['middleware' => 'guest'],function(){
        Route::get('/signup', [
            'uses'=> 'UserController@getSignup',
            'as'=> 'user.signup'
        ]);

        Route::post('/signup', [
            'uses'=> 'UserController@postSignup',
            'as'=> 'user.signup'
        ]);

        Route::get('/signin', [
            'uses'=> 'UserController@getSignin',
            'as'=> 'user.signin'
        ]);

        Route::post('/signin', [
            'uses'=> 'UserController@postSignin',
            'as'=> 'user.signin'
        ]);
    });

    Route::group(['middleware' => 'auth'],function(){
        Route::get('/profile', [
            'uses'=> 'UserController@getProfile',
            'as'=> 'user.profile'
        ]);

        Route::get('/logout', [
            'uses'=> 'UserController@logout',
            'as'=> 'user.logout'
        ]);
    });
});


