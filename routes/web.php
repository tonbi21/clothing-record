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
// トップページ
Route::get('/', 'CoordinatesController@index');

//性別ごとの表示
Route::get('gender', 'CoordinatesController@gender')->name('gender.get');

//コーディネートタイプ別の表示
Route::get('coordinate_type', 'CoordinatesController@coordinate_type')->name('coordinate_type.get');

// 新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('users', 'UsersController', ['only' => ['edit', 'update', 'destroy']]);
    Route::resource('coordinates', 'CoordinatesController', ['only' => ['create', 'store', 'edit','update', 'destroy']]);
    
});

Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
Route::resource('coordinates', 'CoordinatesController', ['only' => ['show']]);
