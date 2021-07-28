<?php

use Facade\FlareClient\Api;
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

Route::get('/accomodation', 'Api\AccomodationController@index');
Route::get('/accomodation/filtered', 'Api\AccomodationController@filtered');
Route::get('/services', 'Api\ServiceController@index');
Route::get('/images/{id}', "Api\ImageController@index");
