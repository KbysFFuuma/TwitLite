@extends('layouts.app')

@section('content')
<div class="container">
	<div class="welcomePage">
			<h1 class="welcomeLabel">
				<img src="https://s3-ap-northeast-1.amazonaws.com/ffmn-twitlite/parts/titleLogo.png" id ="titleLogo" alt="titleLogo">

			</h1>
			<ul class="welcomeSelect">
				<li class="welcome-menu"><a href="/login"><img src="https://s3-ap-northeast-1.amazonaws.com/ffmn-twitlite/parts/right-finger.png"
					width="30px" height="30px">ログイン</a></li>
				<li class="welcome-menu"><a href="/register"><img src="https://s3-ap-northeast-1.amazonaws.com/ffmn-twitlite/parts/right-finger.png"
					 width="30px" height="30px">新規登録</a></li>
			</ul>
	</div>
<footer class="welcomeFooter">
	<a href="https://github.com/KbysFFuuma/twitLite"><img src="https://s3-ap-northeast-1.amazonaws.com/ffmn-twitlite/parts/GitHub-Mark-64px.png"
		width="50px" height="50px"></a>
</footer>
</div>
@endsection
