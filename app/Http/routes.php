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

Route::get('orion', 'OrionController@index');
Route::post('orion', 'OrionController@store');
Route::get('orion/{id}', 'OrionController@show');
Route::delete('orion/{id}', 'OrionController@destroy');
Route::put('orion/{id}', 'OrionController@update');

Route::get('idas', 'IDASController@index');
Route::post('idas', 'IDASController@store');
Route::get('idas/{id}', 'IDASController@show');
Route::delete('idas/{id}', 'IDASController@destroy');
Route::put('idas/{id}', 'IDASController@update');