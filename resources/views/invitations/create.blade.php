@extends('layouts.master')

@section('content')
	<h1>Create Invitation</h1>

	{!! Form::open(['route' => 'invitations.store', 'role' => 'form']) !!}

	<div class="form-group">
		<label for="email">Email</label>
		{!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
	</div>

	@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">{!! $error !!}</div>
	@endforeach

	{!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
	{!! Form::close() !!}
@stop