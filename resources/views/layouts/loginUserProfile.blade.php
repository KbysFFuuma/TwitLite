<!-- プロフィール -->
<section class="profile">
  <img src="/storage/{{$loginUser->icon}}" id ="pf-icon" alt="profile-icon">
  <section class="this_user">
    <p id="user_name">{{$loginUser->name}}</p>
    <a href="">{{"@" .$loginUser->userId}}</a>
  </section>

  <section class="user_info">
    <ul class="tweet rel">
      <li>ツイート</li>
      <li><a href="">{{$userTweetCnt}}</a></li>
    </ul>
    <ul class="follow rel">
      <li>フォロー</li>
      <li><a href="">50</a></li>
    </ul>
    <ul class="follower rel">
      <li>フォロワー</li>
      <li><a href="">10</a></li>
    </ul>
