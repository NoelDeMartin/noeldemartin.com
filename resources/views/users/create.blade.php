@extends('layouts.master')

@section('content')
	<h1>Create User</h1>

	<form action="{!! route('users.store') !!}" role="form" method="POST">

		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" placeholder="Username" class="form-control">
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" placeholder="Email" class="form-control">
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" placeholder="Password" class="form-control"> <br>
			<input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
		</div>

		@foreach ($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{!! $error !!}</div>
		@endforeach

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<input type="submit" value="Submit" class="btn btn-default">

	</form>
@stop
