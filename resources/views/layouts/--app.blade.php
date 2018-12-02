<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>tweetClone</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
  <style type="text/css">
		font-family: -apple-system, BlinkMacSystemFont, 'Helvetica Neue', 'Hiragino Kaku Gothic ProN', 'メイリオ', meiryo, sans-serif;
   </style>
</head>
<body>
	@guest
		<li class="nav-item">
				<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
		</li>
		<li class="nav-item">
				@if (Route::has('register'))
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
				@endif
		</li>
	@else

		<!-- タブメニュー -->
	  <header class="tab-menu">
	    <ul class="menu">
	      <li><a href=""><img src="/storage/img/parts/home.png" id="home_icon" width="16px" height="16px"> ホーム</a></li>
	      <!-- <li><a href="">プロフィール</a></li> -->
	      <li><a href=""><img src="/storage/img/parts/user.png" id="user_icon" width="16px" height="16px"> 登録ユーザー</a></li>
	      <li><a href=""><img src="/storage/img/parts/system.png" id="system_icon" width="16px" height="16px"> 設定</a></li>
	      <!-- <li><a href=""><img src="/storage/img/parts/logout.png" id="logout_icon" width="16px" height="16px"> ログアウト</a></li> -->
				<li class="nav-item dropdown">
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
									 onclick="event.preventDefault();
																 document.getElementById('logout-form').submit();"><img src="/storage/img/parts/logout.png" id="logout_icon" width="16px" height="16px">
										{{ __('ログアウト') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
								</form>
						</div>
				</li>

	    </ul>
	  </header>
	@endguest

	@yield('content')
</body>
</html>
