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

Route::get('/', 'FeedController@feed')->name('home')
    ->middleware('auth');

Route::post('/', 'FeedController@store')
    ->middleware('auth');

// GitHub OAuth routes
Route::get('login/github', 'Auth\LoginController@redirectToProvider')
    ->name('login');

Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('logout', 'Auth\LogoutController@logout')->name('logout');