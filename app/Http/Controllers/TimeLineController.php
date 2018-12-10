<?php

namespace App\Http\Controllers;
use App\User;
use App\PostTweet;
use App\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TimeLineController extends Controller
{
  /*-----------------------------------------------------------------*/
  /*function    :ログインユーザーのタイムラインを表示する               */
  /*return View :userPage.blade.php                                  */
  /*-----------------------------------------------------------------*/
  /*
  */
    //ログインユーザーのタイムラインを表示する
    public function getIndex(Request $request) {

      $userInfo= Auth::user();

      //フォロー一覧を取得
      $subQueryFollows =  DB::table('followers')
                    ->select('followedUserId')
                    ->where('followers.followingUserId' , $userInfo->id);

      // //いいね！したツイート一覧を取得
      // $subQueryFavorites = DB::table('favorites')
      //               ->select('favoritedPostId')
      //               ->where('favorittingUserId', $userInfo->id);

      /*----------------------*/
      /*TL一覧を取得する       */
      /*----------------------*/
      $userTweets = PostTweet::select('postTweets.postId', 'postTweets.usersId'
                            , 'postTweets.postText', 'postTweets.created_at'
                            , 'users.id', 'users.userId', 'users.name', 'users.icon')
                    ->join('users', 'users.id', '=', 'postTweets.usersId')
                    ->leftJoin(DB::raw("({$subQueryFollows->toSql()}) as followed"), 'followed.followedUserId','=', 'users.id')
                    // ->leftJoin(DB::raw("({$subQueryFavorites->toSql()}) as favorited"), 'favorited.favoritedPostId','=', 'postTweets.postId')
                    ->whereNotNull('followed.followedUserId')
                    ->orWhere('users.id', $userInfo->id)
                    ->mergeBindings($subQueryFollows)
                    // ->mergeBindings($subQueryFavorites)
                    ->orderBy('postTweets.created_at', 'decs')
                    ->paginate(20);

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
      //アイコンイメージ
      $url = Storage::disk('s3')->url($userInfo->icon);
      $userInfoAry[$userInfo->id]['userIcon'] = $url;

      foreach ($userTweets as $row) {

        /*-------------------------------------*/
        /*ツイートユーザーのアイコンを取得        */
        /*-------------------------------------*/
        $url = Storage::disk('s3')->url($row->icon);
        $userInfoAry[$row->id]['userIcon'] = $url;

        /*-------------------------------------*/
        /*ログインユーザーがいいね済みか確認      */
        /*-------------------------------------*/

        //いいねしているか確認(true==1)
        $isFavorited = DB::table('favorites')->where(
          ['favorittingUserId' => $userInfo->id , 'favoritedPostId' => $row->postId]
          )->count();

        //情報をリストへ格納
        $favoriteInfoAry[$row->postId]['isFavorite'] = $isFavorited;
      }

      return view('/timeLine', compact('userInfo', 'userTweets', 'userInfoAry'
                , 'favoriteInfoAry'));
    }

}
