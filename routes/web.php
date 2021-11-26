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
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

// ====================================================
//ログアウト中のページ
// ====================================================

// ログイン
Route::get('/login',
            'Auth\LoginController@login'
            )
        ->name('login');

Route::post('/login',
             'Auth\LoginController@login'
            )
        ->name('login');


//ユーザー新規登録
Route::get('/register',
             'Auth\RegisterController@register'
            );
Route::post('/register',
             'Auth\RegisterController@register'
            );

//登録完了画面
Route::get('/added',
            'Auth\RegisterController@added'
            );

// ====================================================
//ログイン中のページ
// ====================================================

// トップ画面
Route::get('/top',
            'PostsController@index'
            )
        ->name('top');
// 新規投稿
Route::post('/createTweet',
            'PostsController@createTweet'
            )
        ->name('createTweet');
//編集
Route::post('/editTweet',
            'PostsController@editTweet'
            )
        ->name('editTweet');
//削除
Route::get('/deleteTweet/{id}',
            'PostsController@deleteTweet'
            )
        ->name('deleteTweet');
// ログインユーザープロフィール
Route::get('/profile',
            'UsersController@profile'
            );

//ユーザー検索
Route::get('/search',
            'UsersController@search'
            )
        ->name('userSearch');
Route::post('/search',
            'UsersController@search'
            )
        ->name('userSearch');

//フォローをする
Route::get('/follow/{id}',
            'UsersController@followBtn'
            )
        ->name('followBtn');

//フォローを外す
Route::get('/unfollow/{id}',
            'UsersController@unfollowBtn'
            )
        ->name('followBtn');


// フォローリスト画面
Route::get('/following',
            'FollowsController@followingList'
            );

// フォロワーリスト
Route::get('/followed',
            'FollowsController@followedList'
            );

//ログアウト
Route::get('/logout',
            'Auth\LoginController@logout'
            );
// ====================================================
