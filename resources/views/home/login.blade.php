@extends('layouts.master')

@section('content')
	<h1>Login</h1>

	<form action="{!! route('process_login') !!}" role="form" method="POST">

		<div class="form-group">
			<input type="text" name="credential" placeholder="Username or Email" class="form-control"> <br>
			<input type="password" name="password" placeholder="Password" class="form-control">
		</div>

		@foreach ($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{!! $error !!}</div>
		@endforeach

		<label>
			<input type="checkbox" name="remember" value="true">
			<span class="text">Remember Credentials</span>
		</label> <br>

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<input type="submit" value="Submit" class="btn btn-default">
	</form>
@stop
