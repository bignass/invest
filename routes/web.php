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

Route::get('/dashboard', function () {
  return view('dashboard');
});

Auth::routes(['verify' => true]);
/*
 *Route::get('/', function () {
 * return view('home');
 *})->name('home');
 */

Route::get('/', 'HomeController@index')->name('home');

Route::get('/edit/user', 'UserController@edit')->name('user.edit');
Route::post('/edit/user', 'UserController@update')->name('user.update');
Route::get('/user/{id}', 'UserController@show')->name('user.show');
Route::get('/screener', function(){return view('pages.screener');});
Route::get('/chart', function(){return view('pages.chart');});


Route::resource('/posts', 'PostController');
Route::get('/post/{id}', 'FollowController@create')->name(
  'follow.create');


Route::get('/follow/create/{id}', 'FollowController@create')->name(
  'follow.create'
);
Route::delete('/follow/{follow}', 'FollowController@destroy')->name(
  'follow.destroy'
);
