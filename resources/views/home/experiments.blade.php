@extends('layouts.master')

@section('content')
	<article id="experiments" class="readable-text">
		<h1>Experiments</h1>
		<ul>
			<li>{!! Html::linkRoute('experiments.freedom-calculator', 'Freedom Calculator') !!}</li>
			<li>{!! Html::linkRoute('experiments.online-meeting', 'Online Meeting') !!}</li>
			<li>{!! Html::linkRoute('experiments.synonymizer', 'Random Synonymizer') !!}</li>
			<li>...</li>
		</ul>
	</article>
@stop