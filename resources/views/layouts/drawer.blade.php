<header>
  <div id="nav-drawer">
      <input id="nav-input" type="checkbox" class="nav-unshown">
      <label class="nav-icon" for="nav-input"><span>
        <img src="{{Storage::disk('s3')->url(Auth::user()->icon)}}" id ="pf-icon" alt="profile-icon"></span></label>
      <label class="nav-unshown" id="nav-close" for="nav-input"></label>
      <div id="nav-content">

        <ul class="drawer-menu">
        <li><a class="drawer-brand" href="/{{Auth::user()->userId}}">
          <img src="{{Storage::disk('s3')->url(Auth::user()->icon)}}" id ="pf-icon" alt="profile-icon"></a></li>
        <li><a class="drawer-menu-item" href="#">
          <ul class="drawer_names">
            <li>{{Auth::user()->name}}</li>
            <li>{{"@" .Auth::user()->userId}}</li>
          </ul></a>
        </li>
        <li><a class ="drawer-menu-item" href="/{{Auth::user()->userId}}">マイプロフィール</a></li>
        <li>
          <ul class="drawer_userCnt">
            <li>ツイート　</li>
            <li><a class ="drawer-menu-item" href="/{{Auth::user()->userId}}">{{$userInfoAry[Auth::user()->id]['userTweetCnt']}}</a></li>
          </ul>
        </li>
        <li>
          <ul class="drawer_userCnt">
            <li>フォロー　</li>
            <li><a class ="drawer-menu-item"  href="/{{Auth::user()->userId}}/followList">{{$userInfoAry[Auth::user()->id]['followedCnt']}}</a></li>
          </ul>
        </li>
        <li>
          <ul class="drawer_userCnt">
            <li>フォロワー</li>
            <li><a class ="drawer-menu-item"  href="/{{Auth::user()->userId}}/followerList">{{$userInfoAry[Auth::user()->id]['followerCnt']}}</a></li>
          </ul>
        </li>
      </ul>

      </div>
  </div>
</header>
