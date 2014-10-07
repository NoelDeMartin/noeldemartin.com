@extends('layouts.master')

@section('content')
	<h1>Users</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Username</th>
				<th></th>
				<th>Email</th>
				<th>Roles</th>
				<th>Created At</th>
				<th>Updated At</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{HTML::linkAction('users.show', $user->username, $user->id) }}</td>
					<td>{{HTML::linkAction('users.edit', 'edit', $user->id) }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ implode(', ', $user->getRolesArray()) }}</td>
					<td>{{ $user->created_at }}</td>
					<td>{{ $user->updated_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ Html::linkAction('users.create', 'New User', [], ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) }}
@stop