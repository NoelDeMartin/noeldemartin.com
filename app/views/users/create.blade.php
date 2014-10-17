@extends('layouts.master')

@section('content')
	<h1>Create User</h1>

	{{ Form::open(['route' => 'users.store'], ['role' => 'form']) }}

	<div class="form-group">
		<label for="username">Username</label>
		{{ Form::text('username', null, ['placeholder' => 'Username', 'class' => 'form-control']) }}
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		{{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		{{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }} <br>
		{{ Form::password('confirm_password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) }}
	</div>

	@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">{{ $error }}</div>
	@endforeach

	{{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
	{{ Form::close() }}
@stop