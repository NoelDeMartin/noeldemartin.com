@extends('layouts.master')

@section('content')
    <h1>Users</h1>

    <table class="table">

        <thead>

            <tr>

                <th>Username</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Created At</th>
                <th>Updated At</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($users as $user)
                <tr>

                    <td>
                        <a href="{{ route('users.show', [$user->id]) }}">
                            {{ $user->username }}
                        </a>
                    </td>

                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ', $user->getRolesArray()) }}</td>
                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                    <td>{{ $user->updated_at->toFormattedDateString() }}</td>

                </tr>
            @endforeach

        </tbody>

    </table>
@endsection
