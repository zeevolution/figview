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


Route::post('oauth/access_token', function(){
    return Response::json(\LucaDegasperi\OAuth2Server\Facades\Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function(){
    Route::resource('orion', 'OrionController', ['except' => ['create', 'edit']]);
    Route::resource('idas', 'IDASController', ['except' => ['create', 'edit']]);
    Route::resource('iotenv', 'IotEnvsController', ['except' => ['create', 'edit']]);
});