@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row">
			<!-- 左サイド -->
			<aside class="userProfile col-md-3.5">
					@include('layouts.userProfile')
			</aside>
			<!-- <div class="row justify-content-center"> -->

			<!-- 登録ユーザー一覧を表示 -->
			<section class="main-content col-xs-12 col-sm-12 col-md-8">
				<article class="members">
					@include('layouts.membersList')
				</article>
			</section>
		</div>
</div>

@endsection
