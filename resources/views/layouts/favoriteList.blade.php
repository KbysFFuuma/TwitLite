<!-- タイムライン -->

@foreach ($favariteTweets as $tweetRow)
  <!-- 1tweet -->
  <hr>
  <section class="contents">
  <!-- アイコン -->
  <img src="/storage/img/icon/{{$tweetRow->icon}}" id ="userMiniIcon" alt="profile-icon">
  <!-- ユーザー名 -->
  <div class="user_block">
  <a href="/{{$tweetRow->userId}}">{{$tweetRow->name}}</a>
  <a href="/{{$tweetRow->userId}}">{{'@' .$tweetRow->userId}}</a>
  {{"[" .$tweetRow->created_at. "]"}}
  </div>
  <!-- ツイート内容 -->
  <div>
  <p>{{$tweetRow->postText}}</p>
  </div>
  <!-- ツイートへのイベント -->
  <ul class="tweet_action text-right">
    <li>
      @if ($favoriteInfoAry[$tweetRow->postId]['isFavorite'])
        <!--「いいね！解除」ボタンの表示-->
        <form action="/unFavoriteTweet" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="postId" value="{{$tweetRow->postId}}">
          <input type="submit" class="favorite-btn btn btn-warning" value="いいね！">
        </form>
      @else
        <!--「いいね！」ボタンの表示 -->
        <form action="/favoriteTweet" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="postId" value="{{$tweetRow->postId}}">
          <input type="submit" class="favorite-btn btn btn-default" value="いいね！">
        </form>
      @endif

    </li>
    <!-- 自分のツイートしか削除ボタンは表示させない -->
    @if(Auth::user()->id == $tweetRow->usersId)
      <li>
        <form action="/deleteTweet" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="postId" value="{{$tweetRow->postId}}">
        <input type="submit" class="delete-btn btn btn-danger" value="削除">
        </form>
      </li>
    @endif
  </ul>
  </section>
@endforeach
{{$favariteTweets->links()}}
<hr>
