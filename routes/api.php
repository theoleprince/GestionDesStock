<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\EmailController;
use App\Mail\ContactMail;


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

Route::group(['prefix'=>'Categorie'], function(){
    Route::post('/', 'CategorieController@create'); 
    Route::match(['post','put'],'/{id}', 'CategorieController@update');  
    Route::delete('/{id}', 'CategorieController@destroy');  
    Route::get('/', 'CategorieController@index');  
    Route::get('/{id}','CategorieController@find');
});

Route::group(['prefix'=>'Magasin'], function(){
    Route::post('/', 'MagasinController@create'); 
    Route::match(['post','put'],'/{id}', 'MagasinController@update');  
    Route::delete('/{id}', 'MagasinController@destroy');  
    Route::get('/', 'MagasinController@index'); 
    Route::get('/{id}','MagasinController@find'); 
});

Route::group(['prefix'=>'Produit'], function(){
    Route::post('/', 'ProduitController@create'); 
    Route::match(['post','put'],'/{id}', 'ProduitController@update');  
    Route::delete('/{id}', 'ProduitController@destroy');  
    Route::get('/', 'ProduitController@index');
    Route::get('/{id}','ProduitController@find');  
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
    Route::get('signup/activate/{token}', [AuthController::class,'signupActivate']);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class,'logout']);
        Route::get('user', [AuthController::class,'user']);
    });
});

Route::group([    
    'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', [PasswordResetController::class,'create']);
    Route::get('find/{token}', [PasswordResetController::class,'find']);
    Route::post('reset', [PasswordResetController::class,'reset']);
});

Route::get('/contact', [EmailController::class,'create']);
Route::post('/store', [EmailController::class,'store']);

