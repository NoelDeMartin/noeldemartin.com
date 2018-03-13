@extends('layouts.master')

@section('content')
	<h1>Create Invitation</h1>

	<form action="{!! route('invitations.store') !!}" role="form" method="POST">

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" placeholder="Email" class="form-control">
		</div>

		@foreach ($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{!! $error !!}</div>
		@endforeach

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<input type="submit" value="Submit" class="btn btn-default">
	</form>
@stop
