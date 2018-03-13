@extends('layouts.master')

@section('content')
	<article id="experiments" class="readable-text">
		<h1>Experiments</h1>
		<ul>
			<li><a href="{!! route('experiments.freedom-calculator') !!}">Freedom Calculator</a></li>
			<li><a href="{!! route('experiments.online-meeting') !!}">Online Meeting</a></li>
			<li><a href="{!! route('experiments.synonymizer') !!}">Random Synonymizer</a></li>
			<li>...</li>
		</ul>
	</article>
@stop
