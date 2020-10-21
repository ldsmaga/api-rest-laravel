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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Rota para login/gerar token:
Route::post('auth/login', 'Api\AuthController@login');

//Rota para criar usuário:
Route::post('user/create', 'UserController@store');

//Rotas protegidas pelo middleware de validação da autenticação:

    //AuthController:
Route::group(['middleware' => 'apiJwt', 'prefix'=>'auth'], function () {

    Route::get('users', 'Api\AuthController@listUsers');
    Route::get('me', 'Api\AuthController@me');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
});

    //ProductController:
Route::group(['middleware' => 'apiJwt', 'prefix'=>'product'], function () {
    Route::get('show', 'ProductController@index');
    Route::get('show/{id}', 'ProductController@show');
    Route::post('create', 'ProductController@store');
    Route::put('update/{id}', 'ProductController@update');
    Route::delete('delete/{id}', 'ProductController@destroy');
});

    //UserController:

Route::group(['middleware' => 'apiJwt', 'prefix'=>'user'], function () {
    Route::get('show', 'UserController@index');
    Route::put('update', 'UserController@update');
    Route::delete('delete', 'UserController@destroy');
});
