@extends('layouts.master')

@section('content')
	<h1>{{ $user->username }}</h1>

	{{ var_dump($user) }}
@stop