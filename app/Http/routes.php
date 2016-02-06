<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->group(['namespace' => 'Begin\Http\Controllers\Api\v1\Auth','prefix' => 'api/v1'], function () use($app) {
		
	$app->post('register','AuthController@postRegister');
	$app->post('login','AuthController@postLogin');
	
	$app->get('user', 'AuthController@getUser');
	$app->get('token/validate', 'AuthController@validateToken');
});

$app->group(['namespace' => 'Begin\Http\Controllers\Api\v1','prefix' => 'api/v1'], function () use ($app) {	
	
	$app->get('tasks/pending', 'TasksController@getPending');
	$app->get('tasks/completed', 'TasksController@getCompleted');
	$app->get('tasks', 'TasksController@index');
	$app->post('tasks', 'TasksController@store');
	$app->get('tasks/{id}', 'TasksController@show');
	$app->put('tasks/{id}', 'TasksController@update');
	$app->delete('tasks/{id}', 'TasksController@destroy');
});