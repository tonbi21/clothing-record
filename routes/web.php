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
    Route::get('users/{user}/withdrawal', 'UsersController@withdrawal')->name('users.withdrawal');
    Route::resource('coordinates', 'CoordinatesController', ['only' => ['create', 'store', 'edit','update', 'destroy']]);
    Route::resource('items', 'ItemsController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    
});

Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
Route::resource('coordinates', 'CoordinatesController', ['only' => ['show']]);
Route::resource('items', 'ItemsController', ['only' => ['index', 'show']]);


// フォロー
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'user/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
    });
});

Route::group(['prefix' => 'user/{id}'], function () {
    Route::get('myitems', 'UsersController@myitems')->name('users.myitems');
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('followers', 'UsersController@followers')->name('users.followers');
    Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
});

// お気に入り
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'coordinates/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
});
