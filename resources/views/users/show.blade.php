@extends('layouts.master')

@section('content')

    <h1>{{ $user->username }}</h1>

    <pre class="p-4 bg-grey-lighter rounded">{{ json_encode($user->toArray(), JSON_PRETTY_PRINT) }}</pre>

@endsection