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

Route::get('/','Web\AppController@getApp')->middleware('auth');

Route::get('/login','Web\AppController@getLogin')->name('login')->middleware('guest');

//注册登录认证路由 social 代表Oauth提供方 这里是github
Route::get('/auth/{social}','Web\AuthenticationController@getSocialRedirect')->middleware('guest');
Route::get('/auth/{social}/callback','Web\AuthenticationController@getSocialCallback')->middleware('guest');