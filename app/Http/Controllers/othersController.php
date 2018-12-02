<?php

namespace App\Http\Controllers;

use App\User;
use App\PostTweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class othersController extends Controller
{

  /*-----------------------------------------------------------------*/
  /*function    :登録者一覧ページを表示する                            */
  /*return View :userPage.blade.php                                  */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function membersList(Request $request) {
        $userInfo = Auth::user();

        /*-------------------------------------------*/
        /*ログインユーザー以外の登録ユーザーを取得する   */
        /*-------------------------------------------*/
        $members = User::select('users.id', 'users.userId'
                          , 'users.name','users.icon')
                          ->where('users.id', '!=', $userInfo->id)
                          ->paginate(5);;

        /*-----------------------------*/
        /*ログインユーザーの情報を取得    */
        /*-----------------------------*/

        //ログインユーザーのカウント情報を取得
        $userTweetCnt = PostTweet::where('usersId',$userInfo->id)->count();
        $followedCnt = DB::table('followers')->where('followingUserId', $userInfo->id)->count();
        $followerCnt = DB::table('followers')->where('followedUserId', $userInfo->id)->count();

        //ログインユーザーの情報をリストへ格納
        $userInfoAry = array();
        $userInfoAry[$userInfo->id]['userTweetCnt'] = $userTweetCnt;
        $userInfoAry[$userInfo->id]['followedCnt'] = $followedCnt;
        $userInfoAry[$userInfo->id]['followerCnt'] = $followerCnt;

        /*-----------------------------*/
        /*登録者一覧のユーザー情報を取得  */
        /*-----------------------------*/
        foreach ($members as $row) {

          //フォローしているか確認(true==1)
          $isFollowed = DB::table('followers')->where(
            ['followingUserId' => $userInfo->id , 'followedUserId' => $row->id]
            )->count();

          //登録一覧ユーザーのカウント情報を取得
          $userTweetCnt = PostTweet::where('usersId',$row->id)->count();
          $followedCnt = DB::table('followers')->where('followingUserId', $row->id)->count();
          $followerCnt = DB::table('followers')->where('followedUserId', $row->id)->count();

          //登録一覧ユーザーの情報をリストへ格納
          $userInfoAry[$row->id]['isFollowed'] = $isFollowed;
          $userInfoAry[$row->id]['userTweetCnt'] = $userTweetCnt;
          $userInfoAry[$row->id]['followedCnt'] = $followedCnt;
          $userInfoAry[$row->id]['followerCnt'] = $followerCnt;
        }

        return view('/membersPage', compact('userInfo', 'members', 'userInfoAry'));
    }

    /*-----------------------------------------------------------------*/
    /*function    :プロフィール変更ページを表示する                       */
    /*return View :userPage.blade.php                                  */
    /*-----------------------------------------------------------------*/
    /*
    */
      public function setting(Request $request) {
          $userInfo = Auth::user();

          /*-----------------------------*/
          /*ログインユーザーの情報を取得    */
          /*-----------------------------*/

          //ログインユーザーのカウント情報を取得
          $userTweetCnt = PostTweet::where('usersId',$userInfo->id)->count();
          $followedCnt = DB::table('followers')->where('followingUserId', $userInfo->id)->count();
          $followerCnt = DB::table('followers')->where('followedUserId', $userInfo->id)->count();

          //ログインユーザーの情報をリストへ格納
          $userInfoAry = array();
          $userInfoAry[$userInfo->id]['userTweetCnt'] = $userTweetCnt;
          $userInfoAry[$userInfo->id]['followedCnt'] = $followedCnt;
          $userInfoAry[$userInfo->id]['followerCnt'] = $followerCnt;

          return view('/settingPage', compact('userInfo', 'userInfoAry'));
      }

}
