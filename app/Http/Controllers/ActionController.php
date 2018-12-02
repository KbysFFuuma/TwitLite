<?php

namespace App\Http\Controllers;
use App\User;
use App\PostTweet;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
  /*-----------------------------------------------------------------*/
  /*function    :ツイートをポストする                                  */
  /*return View :redirect('/')                                       */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function postTweet(Request $request) {
      //NULLの場合、ポストしない。
      if (is_null($request->tweetArea)) {
        if ($request->tweetArea !== 0) {
          return back();
        }
      }
      $loginUser = Auth::user();
      $postTweet = new PostTweet;
      $postTweet->usersId = $loginUser->id;
      $postTweet->postText = $request->tweetArea;
      $postTweet->postImage = 'img/default.png';
      $postTweet->save();
      return redirect('/');
    }

  /*-----------------------------------------------------------------*/
  /*function    :ツイートをデリートする                                */
  /*return View :back()                                              */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function deleteTweet(Request $request) {
      DB::table('favorites')->where('favoritedPostId', $request->postId)
        ->delete();

      PostTweet::find($request->postId)->delete();
      return back();
    }

  /*-----------------------------------------------------------------*/
  /*function    :ツイートをいいね！する                                */
  /*return View :back()                                              */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function favoriteTweet(Request $request) {
      $loginUser = Auth::user();
      DB::table('favorites')->insert(
        ['favorittingUserId' => $loginUser->id , 'favoritedPostId' => $request->postId]
      );
      return back();
    }

  /*-----------------------------------------------------------------*/
  /*function    :いいね！を解除する                                    */
  /*return View :back()                                              */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function unFavoriteTweet(Request $request) {
      $loginUser = Auth::user();
      DB::table('favorites')->where(
        ['favorittingUserId' => $loginUser->id , 'favoritedPostId' => $request->postId]
      )->delete();
      return back();
    }

  /*-----------------------------------------------------------------*/
  /*function    :ユーザーをフォローする                                */
  /*return View :back()                                              */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function followUser(Request $request) {
      $loginUser = Auth::user();
      DB::table('followers')->insert(
        ['followingUserId' => $loginUser->id , 'followedUserId' => $request->followerId]
      );
      return back();
    }

  /*-----------------------------------------------------------------*/
  /*function    :ユーザーをアンフォローする                            */
  /*return View :back()                                              */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function unFollowUser(Request $request) {
      $loginUser = Auth::user();
      DB::table('followers')->where(
        ['followingUserId' => $loginUser->id , 'followedUserId' => $request->followerId]
      )->delete();
      return back();
    }

  /*-----------------------------------------------------------------*/
  /*function    :プロフィールを変更する                                */
  /*return View :back()                                              */
  /*-----------------------------------------------------------------*/
  /*
  */
    public function profileChanged(ProfileRequest $request) {
        $userInfo = Auth::user();

        //ユーザーIDと名前を変更する
        User::where('id', $userInfo->id)
        ->update([
          'userId' => $request->userId,
          'name' => $request->name,
        ]);
        //変更するアイコンがセットされている場合
        if (!is_null($request->icon)) {
          //ファイル名を取得
          $imageName = 'userIcon' .$userInfo->id. '.'
          . $request->file('icon')->getClientOriginalExtension();
          //storageへファイル保存
          $request->file('icon')->storeAs('public/img/icon', $imageName);
          //データベースをアップデート
          User::where('id', $userInfo->id)
          ->update([
            'icon' => $imageName,
          ]);
        }

        //変更後再読込
        $userInfo = Auth::user();

        $isChanged = true;
        return redirect('/setting')->with('isChanged', true);
    }
}
