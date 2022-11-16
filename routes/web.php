<?php

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

Auth::routes();

Route::get('/', 'ViewController@index');
Route::get('/search/{city}/{tag?}', 'ViewController@search');

Route::group(['middleware' => 'auth'], function() {
	Route::get('/job/create', 'ViewController@create');
	Route::post('/job/create', 'JobController@create');
	Route::get('/job/{id}/publish', 'JobController@publish');
	Route::get('/job/{id}/promote', 'JobController@promote');
	Route::get('/my-jobs', 'JobController@myjobs');

	Route::get('/admin', 'ViewController@admin');
});

Route::get('/job/{id}', 'ViewController@job');
Route::get('/contact-us', 'ViewController@contactUs');
