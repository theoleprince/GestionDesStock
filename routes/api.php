<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([    
    'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::group(['prefix' => 'categorie'], function() {
    Route::post('/','CategorieController@create');
    Route::match(['post','put'],'/{id}', 'CategorieController@update');
    Route::delete('/{id}','CategorieController@destroy');
    Route::get('/','CategorieController@index');
    Route::get('/{id}','CategorieController@find');
});

Route::group(['prefix' => 'magasin'], function() {
    Route::post('/','Magasin1Controller@create');
    Route::match(['post','put'],'/{id}', 'Magasin1Controller@update');
    Route::delete('/{id}','Magasin1Controller@destroy');
    Route::get('/','Magasin1Controller@index');
    Route::get('/{id}','Magasin1Controller@find');
});

Route::group(['prefix' => 'produit'], function() {
    Route::post('/','Produit1Controller@create');
    Route::post('/{id}', 'Produit1Controller@update');
    Route::delete('/{id}','Produit1Controller@destroy');
    Route::get('/','Produit1Controller@index');
    Route::get('/{id}','Produit1Controller@find');
});

Route::group(['prefix' => 'contacte'], function() {
    Route::post('/','ContactController@store');
});
