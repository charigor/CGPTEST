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


Route::post('login','App\Http\Controllers\Api\Auth\LoginController@Login');
Route::group(['middleware' => ['auth:sanctum']],function() {
    Route::get('companies/{id}', 'App\Http\Controllers\Api\ApiController@getClients');
    Route::get('companies', 'App\Http\Controllers\Api\ApiController@getAllCompanies');
    Route::get('clients/{id}', 'App\Http\Controllers\Api\ApiController@getClientCompanies');
    Route::get('clients', 'App\Http\Controllers\Api\ApiController@getAllClients');
});

