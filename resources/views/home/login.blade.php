@extends('layouts.master')

@section('content')
	<h1>Login</h1>

	{!! Form::open(['route' => 'process_login', 'role' => 'form']) !!}

	<div class="form-group">
		{!! Form::text('credential', null, ['placeholder' => 'Username or Email', 'class' => 'form-control']) !!} <br>
		{!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
	</div>

	@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">{!! $error !!}</div>
	@endforeach

	<label>
		{!! Form::checkbox('remember', true) !!}
		<span class="text">Remember Credentials</span>
	</label> <br>

	{!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
	{!! Form::close() !!}
@stop