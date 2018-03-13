@extends('layouts.master')

@section('content')
	<h1>Register</h1>

	@if ($invitation->used)
		<div class="alert alert-warning" role="alert">
			Seems like this invitation has already been used...
		</div>
		<a href="{!! route('home') !!}" class="btn btn-lg btn-primary" role="button">Ok</a>
	@else

		<form action="{!! route('users.store') !!}" role="form" method="POST">

			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" placeholder="Username" class="form-control">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" value="{!! $invitation->email !!}" placeholder="Email" class="form-control">
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" placeholder="Password" class="form-control"> <br>
				<input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
			</div>

			<input type="hidden" name="invitation_token" value="{!! $invitation->token !!}">

			@foreach ($errors->all() as $error)
				<div class="alert alert-danger" role="alert">{!! $error !!}</div>
			@endforeach

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<input type="submit" value="Submit" class="btn btn-default">
		</form>

	@endif

@stop
