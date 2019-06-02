<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('main');

Route::get('/logout','usersController@logout');

Route::get('/rep','activeController@rep');

Route::get('/login',function() {
	return view('login');
});

Route::post('/login','usersController@login')->name('login');

Route::get('/users/getAuth','usersController@getAuth');

Route::get('/c_i','activeController@c_i');

Route::get('/deleteMost','activeController@deleteMost');

Route::get('/image','API\imagesController@index');