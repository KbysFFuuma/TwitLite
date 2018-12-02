<!-- プロフィール -->
<section class="profile">
  <img src="/storage/img/icon/{{$userInfo->icon}}" id ="pf-icon" alt="profile-icon">
  <section class="this_user">
    <p id="user_name">{{$userInfo->name}}</p>
    <a href="/{{$userInfo->userId}}">{{"@" .$userInfo->userId}}</a>
  </section>

  <section class="user_info">
  
    <ul class="tweet rel">
      <li>ツイート</li>
      <li><a href="/{{$userInfo->userId}}">{{$userInfoAry[$userInfo->id]['userTweetCnt']}}</a></li>
    </ul>
    <ul class="follow rel">
      <li>フォロー</li>
      <li><a href="/{{$userInfo->userId}}/followList">{{$userInfoAry[$userInfo->id]['followedCnt']}}</a></li>
    </ul>
    <ul class="follower rel">
      <li>フォロワー</li>
      <li><a href="/{{$userInfo->userId}}/followerList">{{$userInfoAry[$userInfo->id]['followerCnt']}}</a></li>
    </ul>


    @if(Auth::user()->id == $userInfo->id)
      <!-- ログインユーザーへはフォローボタンを表示しない -->
    @else
      @if ($userInfoAry[$userInfo->id]['isFollowed'])
        <!-- フォローしている場合は「アンフォロー」ボタンを表示する -->
        <form action="/unFollow" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="followerId" value="{{$userInfo->id}}">
          <input type="hidden" name="followerUserId" value="{{$userInfo->userId}}">
          <div class="text-right"><input type="submit" class="btn btn-success" value="アンフォロー"></div>
        </form>
      @else
        <!-- フォローしていない場合は「フォロー」ボタンを表示する -->
        <form action="/follow" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="followerId" value="{{$userInfo->id}}">
          <input type="hidden" name="followerUserId" value="{{$userInfo->userId}}">
          <div class="text-right"><input type="submit" class="btn btn-primary" value="フォロー"></div>
        </form>
      @endif
    @endif

  </section>
