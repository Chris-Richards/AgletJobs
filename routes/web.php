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
	Route::get('/job/application/{id}/submit', 'JobController@apply');

	Route::get('/my-jobs', 'JobController@myjobs');
	Route::get('/my-jobs/visible/{id}', 'JobController@visible');
	Route::get('/candidates/subscribe', 'JobController@subscribe');
	Route::get('/candidates/{f_1?}/{f_2?}', 'JobController@candidates');

	Route::get('/admin', 'ViewController@admin');
	Route::get('/admin/display', 'ViewController@display');
	Route::get('/admin/display/ajax', 'AdminController@ajax');

	Route::get('/admin/blogs', 'ViewController@blogs');
	Route::get('/admin/blog/create', 'ViewController@blogCreate');
	Route::post('/admin/blog/create', 'BlogController@create');
	Route::get('/blog/{id}', 'ViewController@blog');

	Route::post('/profile/update/{type}', 'UserController@update');
});

Route::get('/job/{id}', 'ViewController@job');
Route::get('/contact-us', 'ViewController@contactUs');
Route::post('/contact-us', 'ViewController@contactForm');
Route::get('/about', 'ViewController@about');
