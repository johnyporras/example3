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

Route::get('/','HomeController@index');


Route::get('readarticles',"ReaderController@PocessArticles");
Route::get('relatearticles',"ReaderController@relateArticles");
Route::get('showarticles',"ReaderController@readArticles");
Route::get('listarticles',"ReaderController@listArticles");
Route::get('detailarticle/{id}',"ReaderController@listDetails");



/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api'], function () {
	Route::get('getArticles', 'ReaderController@getArticlesApi');
	Route::get('ShowDetail/{id}',"ReaderController@listDetailsApi");
});


Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('feeds', 'FeedsController');
Route::resource('reader', 'ReaderController');