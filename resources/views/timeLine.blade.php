@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<!-- 左サイド -->
		<aside class="col-md-3.5 col-md-offset-2.5">
				@include('layouts.userProfile')
		</aside>

		<section class="main-content col-md-6 col-md-offset-1 hidden-md">

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
