@extends('layouts.master')

@section('content')
	<h1>Register</h1>

	@if ($invitation->used)
		<div class="alert alert-warning" role="alert">
			Seems like this invitation has already been used...
		</div>
		{!! Html::linkRoute('home', 'Ok', [], ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) !!}
	@else

		{!! Form::open(['route' => 'users.store', 'role' => 'form']) !!}

		<div class="form-group">
			<label for="username">Username</label>
			{!! Form::text('username', null, ['placeholder' => 'Username', 'class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			{!! Form::email('email', $invitation->email, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			{!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!} <br>
			{!! Form::password('confirm_password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
		</div>

		{!! Form::hidden('invitation_token', $invitation->token) !!}

		@foreach ($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{!! $error !!}</div>
		@endforeach

		{!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
		{!! Form::close() !!}

	@endif

@stop