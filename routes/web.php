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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/portfolio', 'PagesController@portfolio');

Route::resource('posts', 'PostController');

Route::get('/search', 'Postcontroller@search');

//comments
Route:: post('comments/{post_id}',['uses'=> 'CommentsController@store', 'as'=> 'comments.store']);
Route:: Post('/postcheck', 'PostController@check')->name('post.check');


Auth::routes();



Route::get('/dashboard', 'DashboardController@index')->name('dasboard'); 
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
 Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::Post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

