@extends('layouts.master')

@section('content')
	<h1>Noel De Martin</h1>

	<ul>
		<li>{{ HTML::linkRoute('users.index', 'Users') }}</li>
		<li>{{ HTML::linkRoute('posts.index', 'Posts') }}</li>
	</ul>
@stop