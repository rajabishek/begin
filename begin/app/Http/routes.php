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

Route::group(['namespace' => 'Api\v1','prefix' => 'api/v1'], function ($app)
{	
	Route::group(['namespace' => 'Auth'], function ($app)
	{
		Route::post('register','AuthController@postRegister');
		Route::post('login','AuthController@postLogin');
		Route::get('user', 'AuthController@getUser');
		Route::get('token/validate', 'AuthController@validateToken');
	});

	Route::get('tasks/pending', 'TasksController@getPending');
	Route::get('tasks/completed', 'TasksController@getCompleted');
	Route::resource('tasks', 'TasksController',['only' => ['index','store','show','update','destroy']]);
});

