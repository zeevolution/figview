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
    return view('app');
});


Route::post('oauth/access_token', function(){
    return Response::json(\LucaDegasperi\OAuth2Server\Facades\Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function(){

    //Route::group(['middleware' => 'check-orion-owner'], function(){
    Route::resource('orion', 'OrionController', ['except' => ['create', 'edit']]);
    //});

    Route::resource('idas', 'IDASController', ['except' => ['create', 'edit']]);

    Route::resource('iotenv', 'IotEnvsController', ['except' => ['create', 'edit']]);

    Route::resource('contextpath', 'ContextTreePathsController', ['except' => ['create', 'edit']]);

    Route::group(['prefix'=>'contextpath'], function() {
        Route::get('/', 'ContextTreePathsController@index');
        Route::post('/', 'ContextTreePathsController@store');
        Route::get('/', 'ContextTreePathsController@show');
        Route::delete('/', 'ContextTreePathsController@destroy');
        Route::put('/', 'ContextTreePathsController@update');
    });

    //Route::resource('devicemodel', 'DeviceModelsController', ['except' => ['create', 'edit']]);
    Route::group(['prefix'=>'iotenv'], function() {
        Route::get('{id}/devicemodel', 'DeviceModelsController@index');
        Route::post('{id}/devicemodel', 'DeviceModelsController@store');
        Route::get('{id}/devicemodel/{idDeviceModel}', 'DeviceModelsController@show');
        Route::delete('devicemodel/{idDeviceModel}', 'DeviceModelsController@destroy');
        Route::put('devicemodel/{idDeviceModel}', 'DeviceModelsController@update');
    });


    Route::resource('iotenvmember', 'IoTEnvMembersController', ['except' => ['create', 'edit']]);

    Route::get('user/authenticated', 'UserController@authenticated');

});

