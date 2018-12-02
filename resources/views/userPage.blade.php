@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<!-- 左サイド -->
		<aside class="col-md-3.5 col-md-offset-2.5">
				@include('layouts.userProfile')
		</aside>

		<section class="main-content col-md-6 col-md-offset-1 hidden-md">

		<!-- タブメニュー -->
		@include('layouts.tabMenu')

		<!------------------------------------------------>
		<!-- 選択したタブから表示するコンテンツを切り替える -->
		<!------------------------------------------------>
		@switch ($selectTabMenu)
			@case ('timeLine')
				<!-- タイムライン -->
				<article clsss="timelineList">
						@include('layouts.timeLine')
				</article>
				@break
			@case ('follow')
			<article clsss="followList">
					@include('layouts.followList')
			</article>
				@break
			@case ('follower')
				<article clsss="followerList">
						@include('layouts.followerList')
				</article>
				@break
			@case ('favorite')
				<article clsss="favoriteList">
						@include('layouts.favoriteList')
				</article>
				@break
			@default
		@endswitch

	</section>
	</div>

</div>

@endsection
