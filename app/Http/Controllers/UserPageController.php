<?php

namespace App\Http\Controllers;

use App\User;
use App\PostTweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{

  /*-----------------------------------------------------------------*/
  /*function    :選択したユーザーのタイムラインを表示する               */
  /*return View :userPage.blade.php                                  */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function getIndex(Request $request, $selectUserId) {

        $loginUser = Auth::user();
        $userInfo = User::where('userId', $selectUserId)->first();

        /*----------------------*/
        /*TL一覧を取得する       */
        /*----------------------*/

        $userTweets = PostTweet::select('postTweets.postId', 'postTweets.usersId'
                              , 'postTweets.postText', 'postTweets.created_at'
                              , 'users.id', 'users.userId', 'users.name', 'users.icon')
                      ->join('users', 'users.id','=','postTweets.usersId')
                      ->where('usersId', $userInfo->id)
                      ->orderBy('postTweets.created_at', 'decs')
                      ->paginate(20);


        /*-----------------------------*/
        /*ログインユーザーの情報を取得    */
        /*-----------------------------*/

        //ログインユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$loginUser->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $loginUser->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $loginUser->id)->count();

        //ログインユーザーの情報をリストへ格納
        $userInfoAry = array();
        $userInfoAry[$loginUser->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$loginUser->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$loginUser->id]['followerCnt'] = $followerCnt;

        /*----------------------*/
        /*ユーザー情報を取得    */
        /*----------------------*/

        //フォローしているか確認(true==1)
        $isFollowed = DB::table('followers')->where(
          ['followingUserId' => $loginUser->id , 'followedUserId' => $userInfo->id]
          )->count();

        //ユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$userInfo->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $userInfo->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $userInfo->id)->count();

        //ユーザーの情報をリストへ格納
        $userInfoAry[$userInfo->id]['isFollowed'] = $isFollowed;
        $userInfoAry[$userInfo->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$userInfo->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$userInfo->id]['followerCnt'] = $followerCnt;

        /*-------------------------------------*/
        /*ログインユーザーがいいね済みか確認      */
        /*-------------------------------------*/
        foreach ($userTweets as $row) {

          //いいねしているか確認(true==1)
          $isFavorited = DB::table('favorites')->where(
            ['favorittingUserId' => $loginUser->id , 'favoritedPostId' => $row->postId]
            )->count();

          //情報をリストへ格納
          $favoriteInfoAry[$row->postId]['isFavorite'] = $isFavorited;
        }

        /*----------------------*/
        /*表示するページを指定    */
        /*----------------------*/
        $selectTabMenu = 'timeLine';

        return view('/userPage', compact('userInfo', 'userTweets'
                  , 'selectTabMenu', 'userInfoAry', 'favoriteInfoAry'));
    }


  /*-----------------------------------------------------------------*/
  /*function    :選択したユーザーのフォローリストを表示する              */
  /*return View :userPage.blade.php                                  */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function followList(Request $request, $selectUserId) {

        $loginUser= Auth::user();

        $userInfo = User::where('userId', $selectUserId)->first();

        /*----------------------*/
        /*フォロー一覧を取得する  */
        /*----------------------*/
        $followUsers = DB::table('followers')->select('users.id', 'users.userId'
                          , 'users.name','users.icon')
                          ->join('users', 'users.id','=','followers.followedUserId')
                          ->where('followers.followingUserId' , $userInfo->id)
                          ->paginate(10);

        /*-----------------------------*/
        /*ログインユーザーの情報を取得    */
        /*-----------------------------*/

        //ログインユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$loginUser->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $loginUser->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $loginUser->id)->count();

        //ログインユーザーの情報をリストへ格納
        $userInfoAry = array();
        $userInfoAry[$loginUser->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$loginUser->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$loginUser->id]['followerCnt'] = $followerCnt;


        /*----------------------*/
        /*ユーザーの情報を取得    */
        /*----------------------*/

        //フォローしているか確認(true==1)
        $isFollowed = DB::table('followers')->where(
          ['followingUserId' => $loginUser->id , 'followedUserId' => $userInfo->id]
          )->count();

        //ユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$userInfo->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $userInfo->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $userInfo->id)->count();

        //ユーザーの情報をリストへ格納
        $userInfoAry[$userInfo->id]['isFollowed'] = $isFollowed;
        $userInfoAry[$userInfo->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$userInfo->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$userInfo->id]['followerCnt'] = $followerCnt;

        /*---------------------------------*/
        /*フォロー一覧のユーザー情報を取得    */
        /*---------------------------------*/

        foreach ($followUsers as $row) {

          //フォローしているか確認(true==1)
          $isFollowed = DB::table('followers')->where(
            ['followingUserId' => $loginUser->id , 'followedUserId' => $row->id]
            )->count();

          //フォロー一覧ユーザーのカウント情報を取得
          $userTweetCnt = PostTweet::where('usersId',$row->id)->count();
          $followedCnt = DB::table('followers')->where('followingUserId', $row->id)->count();
          $followerCnt = DB::table('followers')->where('followedUserId', $row->id)->count();

          //フォロー一覧ユーザーの情報をリストへ格納
          $userInfoAry[$row->id]['isFollowed'] = $isFollowed;
          $userInfoAry[$row->id]['userTweetCnt'] = $userTweetCnt;
          $userInfoAry[$row->id]['followedCnt'] = $followedCnt;
          $userInfoAry[$row->id]['followerCnt'] = $followerCnt;
        }

        /*----------------------*/
        /*表示するページを指定    */
        /*----------------------*/
        $selectTabMenu = 'follow';

        return view('/userPage', compact('userInfo', 'followUsers'
                  , 'selectTabMenu', 'userInfoAry'));
    }


  /*-----------------------------------------------------------------*/
  /*function    :選択したユーザーのフォロワーリストを表示する            */
  /*return View :userPage.blade.php                                  */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function followerList(Request $request, $selectUserId) {

        $loginUser= Auth::user();

        $userInfo = User::where('userId', $selectUserId)->first();

        /*------------------------*/
        /*フォロワー一覧を取得する  */
        /*------------------------*/
        $followUsers = DB::table('followers')->select('users.id', 'users.userId'
                          , 'users.name','users.icon')
                          ->join('users', 'users.id','=','followers.followingUserId')
                          ->where('followers.followedUserId' , $userInfo->id)
                          ->paginate(10);

        /*-----------------------------*/
        /*ログインユーザーの情報を取得    */
        /*-----------------------------*/

        //ログインユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$loginUser->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $loginUser->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $loginUser->id)->count();

        //ログインユーザーの情報をリストへ格納
        $userInfoAry = array();
        $userInfoAry[$loginUser->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$loginUser->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$loginUser->id]['followerCnt'] = $followerCnt;

        /*----------------------*/
        /*ユーザーの情報を取得    */
        /*----------------------*/

        //フォローしているか確認(true==1)
        $isFollowed = DB::table('followers')->where(
          ['followingUserId' => $loginUser->id , 'followedUserId' => $userInfo->id]
          )->count();

        //ユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$userInfo->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $userInfo->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $userInfo->id)->count();

        //ユーザーの情報をリストへ格納
        $followCntInfo = array();
        $userInfoAry[$userInfo->id]['isFollowed'] = $isFollowed;
        $userInfoAry[$userInfo->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$userInfo->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$userInfo->id]['followerCnt'] = $followerCnt;

        /*---------------------------------*/
        /*フォロワー一覧のユーザー情報を取得  */
        /*---------------------------------*/

        foreach ($followUsers as $row) {

          //フォローしているか確認(true==1)
          $isFollowed = DB::table('followers')->where(
            ['followingUserId' => $loginUser->id , 'followedUserId' => $row->id]
            )->count();

          //フォロワー一覧ユーザーのカウント情報を取得
          $userTweetCnt = PostTweet::where('usersId',$row->id)->count();
          $followedCnt = DB::table('followers')->where('followingUserId', $row->id)->count();
          $followerCnt = DB::table('followers')->where('followedUserId', $row->id)->count();

          //フォロー一覧ユーザーの情報をリストへ格納
          $userInfoAry[$row->id]['isFollowed'] = $isFollowed;
          $userInfoAry[$row->id]['userTweetCnt'] = $userTweetCnt;
          $userInfoAry[$row->id]['followedCnt'] = $followedCnt;
          $userInfoAry[$row->id]['followerCnt'] = $followerCnt;
        }

        /*----------------------*/
        /*表示するページを指定    */
        /*----------------------*/
        $selectTabMenu = 'follower';

        return view('/userPage', compact('userInfo', 'followUsers'
                  , 'selectTabMenu', 'userInfoAry'));
    }


  /*-----------------------------------------------------------------*/
  /*function    :選択したユーザーのお気に入りリストを表示する            */
  /*return View :userPage.blade.php                                  */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function favoriteList(Request $request, $selectUserId) {

        $loginUser= Auth::user();

        $userInfo = User::where('userId', $selectUserId)->first();

        /*-------------------------*/
        /*お気に入り一覧を取得する   */
        /*-------------------------*/
        $favariteTweets = PostTweet::select('postTweets.postId', 'postTweets.usersId'
                              , 'postTweets.postText', 'postTweets.created_at'
                              , 'users.id', 'users.userId', 'users.name', 'users.icon')
                      ->join('favorites', 'favorites.favoritedPostId', '=', 'postTweets.postId')
                      ->join('users', 'users.id','=','postTweets.usersId')
                      ->where('favorites.favorittingUserId', $userInfo->id)
                      ->orderBy('postTweets.created_at', 'decs')
                      ->paginate(30);

        /*-----------------------------*/
        /*ログインユーザーの情報を取得    */
        /*-----------------------------*/

        //ログインユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$loginUser->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $loginUser->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $loginUser->id)->count();

        //ログインユーザーの情報をリストへ格納
        $userInfoAry = array();
        $userInfoAry[$loginUser->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$loginUser->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$loginUser->id]['followerCnt'] = $followerCnt;

        /*----------------------*/
        /*ユーザーの情報を取得    */
        /*----------------------*/

        //フォローしているか確認(true==1)
        $isFollowed = DB::table('followers')->where(
          ['followingUserId' => $loginUser->id , 'followedUserId' => $userInfo->id]
          )->count();

        //ユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$userInfo->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $userInfo->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $userInfo->id)->count();

        //ユーザーの情報をリストへ格納
        $userInfoAry[$userInfo->id]['isFollowed'] = $isFollowed;
        $userInfoAry[$userInfo->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$userInfo->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$userInfo->id]['followerCnt'] = $followerCnt;


        /*-------------------------------------*/
        /*ログインユーザーがいいね済みか確認      */
        /*-------------------------------------*/
        foreach ($favariteTweets as $row) {

          //いいねしているか確認(true==1)
          $isFavorited = DB::table('favorites')->where(
            ['favorittingUserId' => $loginUser->id , 'favoritedPostId' => $row->postId]
            )->count();

          //情報をリストへ格納
          $favoriteInfoAry[$row->postId]['isFavorite'] = $isFavorited;
        }

        /*----------------------*/
        /*表示するページを指定    */
        /*----------------------*/
        $selectTabMenu = 'favorite';

        return view('/userPage', compact('userInfo', 'favariteTweets'
                  , 'selectTabMenu', 'userInfoAry', 'favoriteInfoAry'));

    }


}
