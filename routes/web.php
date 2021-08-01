<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@home');

Auth::routes();

Route::prefix('message')
    ->namespace('Message')
    ->name('message.')
    ->group(function () {
        Route::get('/index/{id}', 'MessageController@index')->name('index');
        Route::get('/new-message/{id}', 'MessageController@create')->name('create');
        Route::post('/store/{id}', 'MessageController@store')->name('store');
        route::get('show/{id}', 'MessageController@show')->name('show');
    });

Route::prefix('guest')
    ->namespace('Guest')
    ->name("guest.")
    ->group(function () {
        Route::get('index', "AccomodationController@index")->name("index");

        Route::post('map', "AccomodationController@map")->name("map");
        Route::post('prova', "AccomodationController@prova")->name("prova");
        Route::get('show/{id}', "AccomodationController@show")->name("show");
    });

Route::prefix('logged')
    ->namespace('Logged')
    ->middleware('auth')
    ->name("logged.")
    ->group(function () {
        Route::get('create', "AccomodationController@create")->name("create");
        Route::post('store', "AccomodationController@store")->name("store");
        Route::get('show/{id}', "AccomodationController@show")->name("show");
        Route::get('edit/{id}', "AccomodationController@edit")->name("edit");
        Route::match(["PUT", "PATCH"], "accomodation/{id}/update", "AccomodationController@update")->name("update");
        Route::delete('destroy/{id}', "AccomodationController@destroy")->name("destroy");
        Route::get('area-privata', "UserController@dashboard")->name("dashboard");
        Route::match(["PUT", "PATCH"],'visibility/{id}', "AccomodationController@visibility")->name("visibility");
        Route::get('images/{id}', "ImageController@create")->name("image.create");
        Route::post('create/images/{id}', "ImageController@store")->name("image.store");
        Route::get('sponsorship/create/{id}', "SponsorshipController@create")->name('sponsorship.create');
        Route::post('sponsorship/payment/{id}/store', "SponsorshipController@store")->name('sponsorship.store');
        Route::get('accomodation/stat/{id}', "AccomodationController@stat")->name('stat');
    });

    //ROUTE PER PAGAMENTI BRAINTREE
    Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');
