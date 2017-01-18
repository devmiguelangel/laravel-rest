<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('api', 'APIController');

Route::group([ 'prefix' => 'api', 'as' => 'api.', ], function () {
    Route::get('index', [
        'as'   => 'index',
        'uses' => 'APIController@index',
    ]);

    Route::post('authenticate', [
        'as'   => 'authenticate',
        'uses' => 'APIController@authenticate',
    ]);

    Route::get('headers', [
        'as'   => 'headers',
        'uses' => 'APIController@getHeaders',
    ]);
});

/*Route::group([ 'middleware' => [ 'cors', 'jwt-auth' ] ], function () {

});*/