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
Route::get('/home','UserController@home')->name('home');
Route::get('/login', 'UserController@showLogin')->name('login');


Route::post('/auth', 'UserController@login')->name('auth');



Route::get('user', 'UserController@index');
Route::post('signup', 'PageController@postSignUp');


Route::get('/',[
    'as'=> 'HomePage',
    'uses' => 'PageController@getIndex'
]);

Route::get('signup',[
    'as'=> 'signup',
    'uses' => 'PageController@getSignUp'
]);

Route::get('signin',[
    'as'=> 'signin',
    'uses' => 'PageController@getSignIn'
]);
Route::post('signin', 'PageController@postSignIn');

/*Route::post('signup',[
    'as'=> 'signup',
    'uses' => 'PageController@postSignUp'
]);*/

Route::get('profile',[
    'as'=> 'profile',
    'uses' => 'PageController@getProfile'
]);

Route::get('addStore',[
    'as'=> 'addStore',
    'uses' => 'PageController@getAddStore'
]);
Route::get('restaurant-detail/{id}',[
    'as'=> 'restaurant-detail',
    'uses' => 'RestaurantController@getRestaurant'
]);