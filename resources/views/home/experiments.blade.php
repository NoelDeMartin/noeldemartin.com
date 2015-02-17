@extends('layouts.master')

@section('content')
	<article id="experiments" class="readable-text">
		<h1>Experiments</h1>
		<ul>
			<li>{!! Html::linkRoute('experiments.freedom-calculator', 'Freedom Calculator') !!}</li>
			<li>...</li>
		</ul>
	</article>
@stop