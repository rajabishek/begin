<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Begin\Http\Controllers\Api\v1','prefix' => 'api/v1'], function ($app)
{
	Route::post('register','AuthController@postRegister');
	Route::post('login','AuthController@postLogin');
});

Route::group(['namespace' => 'Begin\Http\Controllers\Api\v1',
			 'prefix' => 'api/v1', 'middleware' => 'jwt.auth'], function ($app)
{	
	Route::get('validate_token', 'AuthController@validateToken');
	Route::get('tasks', 'TasksController@index');
	Route::get('tasks/{task}', 'TasksController@show');
});