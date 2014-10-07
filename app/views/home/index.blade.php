@extends('layouts.master')

@section('content')
	<h1>Noel De Martin</h1>

	@if (Auth::check())
		<p>Logged in as: {{ Auth::user()->username }} {{ HTML::linkRoute('logout', '(Logout)') }}</p>
	@else
		{{ HTML::linkRoute('login', 'Login') }}
	@endif

	<ul>
		<li>{{ HTML::linkRoute('users.index', 'Users') }}</li>
		<li>{{ HTML::linkRoute('posts.index', 'Posts') }}</li>
	</ul>
@stop