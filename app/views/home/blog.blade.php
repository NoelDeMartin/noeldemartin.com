@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@foreach ($posts as $post)
				@include('assets.post_summary', ['post' => $post])
			@endforeach
		</div>
	</div>
@stop