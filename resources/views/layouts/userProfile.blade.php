<!-- プロフィール -->
<section class="profile">
    <div class="profile-upper">
      <div class="upper-element">
        <img src="/storage/img/icon/{{$userInfo->icon}}" id ="pf-icon" alt="profile-icon">
      </div>
      <div class="upper-element">
        <section >
          <p id="user_name">{{$userInfo->name}}</p>
          <a href="/{{$userInfo->userId}}">{{"@" .$userInfo->userId}}</a>
      </div>
    </div>
    <div class="profile-lower">
      <div class="lower-element">
        <ul class="tweet">
          <li>ツイート</li>
          <li><a href="/{{$userInfo->userId}}">{{$userInfoAry[$userInfo->id]['userTweetCnt']}}</a></li>
        </ul>
      </div>
      <div class="lower-element">
        <ul class="follow">
          <li>フォロー</li>
          <li><a href="/{{$userInfo->userId}}/followList">{{$userInfoAry[$userInfo->id]['followedCnt']}}</a></li>
        </ul>
      </div>
      <div class="lower-element">
        <ul class="follewr">
          <li>フォロワー</li>
          <li><a href="/{{$userInfo->userId}}/followerList">{{$userInfoAry[$userInfo->id]['followerCnt']}}</a></li>
        </ul>
      </div>
    </div>


    @if(Auth::user()->id == $userInfo->id)
      <!-- ログインユーザーへはフォローボタンを表示しない -->
    @else
      @if ($userInfoAry[$userInfo->id]['isFollowed'])
        <!-- フォローしている場合は「アンフォロー」ボタンを表示する -->
        <form action="/unFollow" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="followerId" value="{{$userInfo->id}}">
          <input type="hidden" name="followerUserId" value="{{$userInfo->userId}}">
          <div class="text-right"><input type="submit" class="follow-btn btn btn-success" value="アンフォロー"></div>
        </form>
      @else
        <!-- フォローしていない場合は「フォロー」ボタンを表示する -->
        <form action="/follow" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="followerId" value="{{$userInfo->id}}">
          <input type="hidden" name="followerUserId" value="{{$userInfo->userId}}">
          <div class="text-right"><input type="submit" class="follow-btn btn btn-primary" value="フォロー"></div>
        </form>
      @endif
    @endif

  </section>
