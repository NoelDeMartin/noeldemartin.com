@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@foreach ($posts as $post)
				@include('assets.post_summary', ['post' => $post])
			@endforeach
		</div>
	</div>
	<br />
	<div class="alert alert-info">
		<span class="glyphicon glyphicon-fire" aria-hidden="true"></span>
		<strong>You can add {!! Html::linkRoute('blog.rss', 'this') !!} to your rss feed to keep up to date.</strong>
	</div>
@stop