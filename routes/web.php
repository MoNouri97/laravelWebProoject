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
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/hello', function () {
	return '<h1>hello';
});
Route::get('/', 'PagesController@Index');
Route::resource('posts', 'PostsController');
Route::post('posts/tags', 'PostsController@indexTag');
Route::post('/users/follow', 'UsersController@follow');
Route::resource('users', 'UsersController');
Route::get('/users/{user}/admin', 'UsersController@toggleAdmin');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('Dashboard');
