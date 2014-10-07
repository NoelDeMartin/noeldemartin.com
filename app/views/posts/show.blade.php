@extends('layouts.master')

@section('content')
	<h1>{{ $post->title }}</h1>

	{{ var_dump($post) }}
@stop