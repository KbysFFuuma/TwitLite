<!-- フォローリスト -->

@foreach ($followUsers as $followRow)
  <!-- 1tweet -->
  <hr>
  <section class="contents">
  <!-- アイコン -->
  <img src="/storage/img/icon/{{$followRow->icon}}" id ="userMiniIcon" alt="profile-icon">
  <!-- ユーザー名 -->
  <div class="user_block">
  <a href="/{{$followRow->userId}}">{{$followRow->name}}</a>
  <a href="/{{$followRow->userId}}">{{'@' .$followRow->userId}}</a>
  </div>
  <!-- ツイート内容 -->
  <div class="user_info">
    <ul class="tweet rel">
      <li>ツイート</li>
      <li><a href="/{{$followRow->userId}}">{{$userInfoAry[$followRow->id]['userTweetCnt']}}</a></li>
    </ul>
    <ul class="follow rel">
      <li>フォロー</li>
      <li><a href="/{{$followRow->userId}}/followList">{{$userInfoAry[$followRow->id]['followedCnt']}}</a></li>
    </ul>
    <ul class="follower rel">
      <li>フォロワー</li>
      <li><a href="/{{$followRow->userId}}/followerList">{{$userInfoAry[$followRow->id]['followerCnt']}}</a></li>
    </ul>
  </div>
  @if(Auth::user()->id == $followRow->id)
    <!-- ログインユーザーは「アンフォロー」ボタンを表示しない -->
  @else
    @if ($userInfoAry[$followRow->id]['isFollowed'])
      <!-- フォローしている場合は「アンフォロー」ボタンを表示する -->
      <form action="/unFollow" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="followerId" value="{{$followRow->id}}">
        <input type="hidden" name="followerUserId" value="{{$userInfo->userId}}">
        <div class="text-right"><input type="submit" class="btn btn-success" value="アンフォロー"></div>
      </form>
    @else
      <!-- フォローしていない場合は「フォロー」ボタンを表示する -->
      <form action="/follow" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="followerId" value="{{$followRow->id}}">
        <input type="hidden" name="followerUserId" value="{{$followRow->userId}}">
        <div class="text-right"><input type="submit" class="btn btn-primary" value="フォロー"></div>
      </form>
    @endif
  @endif
  </section>
@endforeach
{{$followUsers->links()}}
<hr>
