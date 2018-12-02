<!-- フォローリスト -->

@foreach ($members as $userRow)
  <!-- 1tweet -->
  <hr>
  <section class="contents">
  <!-- アイコン -->
  <img src="/storage/img/icon/{{$userRow->icon}}" id ="userMiniIcon" alt="profile-icon">
  <!-- ユーザー名 -->
  <div class="user_block">
  <a href="/{{$userRow->userId}}">{{$userRow->name}}</a>
  <a href="/{{$userRow->userId}}">{{'@' .$userRow->userId}}</a>
  </div>
  <!-- ツイート内容 -->
  <div class="user_info">
    <ul class="tweet rel">
      <li>ツイート</li>
      <li><a href="">{{$userInfoAry[$userRow->id]['userTweetCnt']}}</a></li>
    </ul>
    <ul class="follow rel">
      <li>フォロー</li>
      <li><a href="">{{$userInfoAry[$userRow->id]['followedCnt']}}</a></li>
    </ul>
    <ul class="follower rel">
      <li>フォロワー</li>
      <li><a href="">{{$userInfoAry[$userRow->id]['followerCnt']}}</a></li>
    </ul>
  </div>
  @if ($userInfoAry[$userRow->id]['isFollowed'])
    <!-- フォローしている場合は「アンフォロー」ボタンを表示する -->
    <form action="/unFollow" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="followerId" value="{{$userRow->id}}">
      <input type="hidden" name="followerUserId" value="{{$userRow->userId}}">
      <div class="text-right"><input type="submit" class="btn btn-success" value="アンフォロー"></div>
    </form>
  @else
    <!-- フォローしていない場合は「フォロー」ボタンを表示する -->
    <form action="/follow" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="followerId" value="{{$userRow->id}}">
      <input type="hidden" name="followerUserId" value="{{$userRow->userId}}">
      <div class="text-right"><input type="submit" class="btn btn-primary" value="フォロー"></div>
    </form>
  @endif
  </section>
@endforeach
{{$members->links()}}
<hr>
