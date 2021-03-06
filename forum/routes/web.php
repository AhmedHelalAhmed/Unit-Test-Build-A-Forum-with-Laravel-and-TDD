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
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads','ThreadsController@index');
Route::get('/threads/{channel}/{thread}','ThreadsController@show');
Route::post('/threads','ThreadsController@store')->middleware('auth');
Route::get('/threads/create','ThreadsController@create')->middleware('auth');

//Route::resource('threads','ThreadsController');

Route::post('/threads/{channel}/{thread}/replies','RepliesController@store')->middleware('auth')->name('add_reply_to_thread');

Route::get('threads/{channel}','ChannelsController@show');

