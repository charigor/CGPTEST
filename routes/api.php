<?php

use App\Http\Controllers\Api\ApiController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::middleware('auth:api')->get('/companies', function (Request $request) {
//    return $request->user();
//});


Route::get('companies/{id}', 'App\Http\Controllers\Api\ApiController@Clients');
Route::get('companies', 'App\Http\Controllers\Api\ApiController@Companies');
Route::get('clients/{id}', 'App\Http\Controllers\Api\ApiController@ClientCompanies');


