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

Route::group(['prefix' => 'categorie'], function() {
    Route::post('/','CategorieController@create');
    Route::match(['post','put'],'/{id}', 'CategorieController@update');
    Route::delete('/{id}','CategorieController@destroy');
    Route::get('/','CategorieController@index');
    Route::get('/{id}','CategorieController@find');
});

Route::group(['prefix' => 'magasin'], function() {
    Route::post('/','MagasinController@create');
    Route::match(['post','put'],'/{id}', 'MagasinController@update');
    Route::delete('/{id}','MagasinController@destroy');
    Route::get('/','MagasinController@index');
    Route::get('/{id}','MagasinController@find');
});

Route::group(['prefix' => 'produit'], function() {
    Route::post('/','ProduitController@create');
    Route::match(['post','put'],'/{id}', 'ProduitController@update');
    Route::delete('/{id}','ProduitController@destroy');
    Route::get('/','ProduitController@index');
    Route::get('/{id}','ProduitController@find');
});
