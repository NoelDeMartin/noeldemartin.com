@extends('layouts.master')

@section('content')
	<article>

		<h1 class="mb-4 text-3xl text-blue-darkest tracking-wide">Experiments</h1>

		<ul>
			<li><a href="{!! route('experiments.freedom-calculator') !!}">Freedom Calculator</a></li>
			<li><a href="{!! route('experiments.online-meeting') !!}">Online Meeting</a></li>
			<li><a href="{!! route('experiments.synonymizer') !!}">Random Synonymizer</a></li>
			<li>...</li>
		</ul>

	</article>
@stop
