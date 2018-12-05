<div class="drawer drawer--left">
  <header role="banner">
    <!-- ハンバーガーボタン -->
    <button type="button" class="drawer-toggle drawer-hamburger visible-xs">
      <!-- <span class="sr-only">toggle navigation</span> -->
      <span class="drawer-icon"><img src="/storage/img/icon/{{$userInfo->icon}}" id ="pf-icon" alt="profile-icon"></span>
    </button>
    <!-- ナビゲーションの中身 -->
    <nav class="drawer-nav" role="navigation">
      <ul class="drawer-menu">
        <li><a class="drawer-brand" href="/{{$userInfo->userId}}">
          <img src="/storage/img/icon/{{$userInfo->icon}}" id ="pf-icon" alt="profile-icon"></a></li>
        <li><a class="drawer-menu-item" href="#">
          <ul class="drawer_names">
            <li>{{$userInfo->name}}</li>
            <li>{{"@" .$userInfo->userId}}</li>
          </ul></a>
        </li>
        <li>
          <ul class="drawer_userCnt">
            <li>ツイート　</li>
            <li><a class ="drawer-menu-item" href="/{{$userInfo->userId}}">{{$userInfoAry[$userInfo->id]['userTweetCnt']}}</a></li>
          </ul>
        </li>
        <li>
          <ul class="drawer_userCnt">
            <li>フォロー　</li>
            <li><a class ="drawer-menu-item"  href="/{{$userInfo->userId}}/followList">{{$userInfoAry[$userInfo->id]['followedCnt']}}</a></li>
          </ul>
        </li>
        <li>
          <ul class="drawer_userCnt">
            <li>フォロワー</li>
            <li><a class ="drawer-menu-item"  href="/{{$userInfo->userId}}/followerList">{{$userInfoAry[$userInfo->id]['followerCnt']}}</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <main role="main">
    <!-- Page content -->
  </main>

  <!-- ドロワーメニューの利用宣言 -->
  <script>
  $(document).ready(function() {
    $('.drawer').drawer();
  });
  </script>
</div>
