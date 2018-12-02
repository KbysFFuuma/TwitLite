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

/*-----------------------*/
/*   ルートのリダイレクト  */
/*-----------------------*/
Route::get('/', function(){
    return redirect('/timeLine');
})->middleware('auth');

/*---------------*/
/*   認証関係     */
/*---------------*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/*---------------------*/
/*   Welcomeページ     */
/*--------------------*/
Route::get('/welcome', function(){
  return view('/welcome');
})->name('welcome');

/*-----------------------*/
/*   登録ユーザ一覧       */
/*-----------------------*/
Route::get('/members', 'othersController@membersList')
->middleware('auth');
/*-----------------------*/
/*   設定変更ページ       */
/*-----------------------*/
Route::get('/setting', 'othersController@setting')
->middleware('auth');


/*--------------------------------------------------------------*/
/*   ログインユーザのタイムラインページ（HOME）                    */
/*   ログイン後はトップページとなる                               */
/*-------------------------------------------------------------*/
Route::get('/timeLine', 'TimeLineController@getIndex')
      ->middleware('auth');

/*--------------------------------------------------------------*/
/*   ユーザのプロフィールページ                                   */
/*   ツイート・フォロー・フォロワー・お気に入り一覧のタブから        */
/*   画面遷移する。                                              */
/*--------------------------------------------------------------*/
Route::get('/{selectUserId}', 'UserPageController@getIndex')
      ->middleware('auth');

Route::get('/{selectUserId}/followList', 'UserPageController@followList')
      ->middleware('auth');

Route::get('/{selectUserId}/followerList', 'UserPageController@followerList')
      ->middleware('auth');

Route::get('/{selectUserId}/favoriteList', 'UserPageController@favoriteList')
      ->middleware('auth');



/*--------------------------------------------------------------*/
/*   ツイート投稿・削除、フォロー・アンフォロー、                   */
/*   お気に入り登録・解除 等のユーザーアクション(POST)              */
/*--------------------------------------------------------------*/

//ツイート投稿・削除
Route::post('/postTweet', 'ActionController@postTweet')
      ->middleware('auth');

Route::post('/deleteTweet', 'ActionController@deleteTweet')
      ->middleware('auth');

//お気に入り登録・解除
Route::post('/favoriteTweet', 'ActionController@favoriteTweet')
      ->middleware('auth');

Route::post('/unFavoriteTweet', 'ActionController@unFavoriteTweet')
      ->middleware('auth');

//フォロー・アンフォロー
Route::post('/follow', 'ActionController@followUser')
      ->middleware('auth');

Route::post('/unFollow', 'ActionController@unFollowUser')
      ->middleware('auth');

//プロフィールの変更
Route::post('/setting', 'ActionController@profileChanged')
->middleware('auth');
