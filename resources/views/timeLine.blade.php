@extends('layouts.app')

@section('content')
<div class="container">
	<!-- モバイル用ナビバー -->
	@include('layouts.drawer')
	<div class="row">
		<!-- 左サイド -->


		<aside class="userProfile col-md-3.5 ">
				@include('layouts.userProfile')
		</aside>

		<section class="main-content col-xs-12 col-sm-12 col-md-8">

		<!-- ツイートフォーム -->
		@include('layouts.tweetForm')

		<!-- タイムライン -->
		<article clsss="timelineList">
				@include('layouts.timeLine')
		</article>

	</section>
	</div>

</div>

@endsection
