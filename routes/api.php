<?php

use Illuminate\Http\Request;

Route::post('/active/store','activeController@store');
Route::post('/active/search','activeController@search');


Route::post('/load/store','loadController@store');
Route::post('/load/update/{id}','loadController@update');
Route::get('/load/destroy/{id}','loadController@destroy');
Route::post('/load/index','loadController@index');
Route::get('/load/show/{id}','loadController@show');


Route::get('/users/index','usersController@index');
Route::post('/users/store','usersController@store');
Route::post('/users/login','usersController@login');
Route::post('images/index','API\imagesController@index');
Route::post('images/store','API\imagesController@store');
Route::post('images/newImage','API\imagesController@store');

////////////////
////// App Controller 
////////////
Route::post('/user/login','API\userController@login');
Route::post('/user/reg','API\userController@reg');

Route::group(['middleware' => 'auth:api'], function(){

	// Load Controller 
	Route::get('/main/rand_fetch', 'API\mainController@rand_fetch');

	// Search Controller 
	Route::post('/search_byName','API\searchController@search_byName');
	Route::get('/load/show/{id}','API\mainController@show');
	Route::get('/load/show/barcode/{barcode}','API\mainController@barcode');
	Route::post('/search_full/{type}','API\searchController@fullSearch');

	//// show Image 
	Route::post('/image/show','API\mainController@show_image');


	/// store lastSearch
	Route::get('/lastsearch/store/{id}','API\lastController@store');
	Route::get('/lastsearch/get','API\lastController@get');

	// Search Active
	Route::post('searchActive','API\searchController@searchActive');
	Route::get('active/{id}','API\mainController@activeShow');




});