<!-- タブメニュー -->
<section class="tab-menu">
  <ul>
    @switch ($selectTabMenu)
      @case('timeLine')
      <!-- タイムライン選択時の表示タブ -->
        <li class="tab-select"><a href="/{{$userInfo->userId}}">
          <img src="https://s3-ap-northeast-1.amazonaws.com/ffmn-twitlite/parts/right-arrow.png" width="10px" height="10px">
          ツイート</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/followList">フォロー</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/followerList">フォロワー</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/favoriteList"> お気に入り</a></li>
        @break
      @case('follow')
      <!-- フォロー選択時の表示タブ -->
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}">ツイート</a></li>
          <li class="tab-select"><a href="/{{$userInfo->userId}}/followList">
            <img src="https://s3-ap-northeast-1.amazonaws.com/ffmn-twitlite/parts/right-arrow.png" width="10px" height="10px">
            フォロー</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/followerList">フォロワー</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/favoriteList"> お気に入り</a></li>
        @break
      @case('follower')
      <!-- フォロワー選択時の表示タブ -->
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}">ツイート</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/followList">フォロー</a></li>
        <li class="tab-select"><a href="/{{$userInfo->userId}}/followerList">
          <img src="https://s3-ap-northeast-1.amazonaws.com/ffmn-twitlite/parts/right-arrow.png" width="10px" height="10px">
          フォロワー</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/favoriteList">お気に入り</a></li>
        @break
      @case('favorite')
      <!-- お気に入り選択時の表示タブ -->
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}">ツイート</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/followList">フォロー</a></li>
        <li class="tab-not-select"><a href="/{{$userInfo->userId}}/followerList">フォロワー</a></li>
        <li class="tab-select"><a href="/{{$userInfo->userId}}/favoriteList">
          <img src="https://s3-ap-northeast-1.amazonaws.com/ffmn-twitlite/parts/right-arrow.png" width="10px" height="10px">
          お気に入り</a></li>
        @break
      @default
    @endswitch
  </ul>
</section>
