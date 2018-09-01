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
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods:POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers:Content-Type, Origin");

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['api', 'cors'], 'prefix' => 'api'], function() {
	Route::post('register', 'APIController@register');
	Route::post('login', 'APIController@login');
	Route::group(['middleware' => 'jwt-auth'], function() {
		Route::get('get_user_details', 'APIController@get_user_details');
	});

} );