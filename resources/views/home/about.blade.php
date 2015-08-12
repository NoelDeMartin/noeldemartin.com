@extends('layouts.master')

@section('content')
	<article id="about" class="readable-text">
		<h1>About Me</h1>

		<p>Hi There!</p>
		<p>My name is Noel De Martin Fernandez. I am a Problem Solver, Software Architect and Entrepreneur. I created {!! Html::link('http://www.lincolnschilli.com', "Lincoln's Chilli") !!} and I am in the process of exploring the market and creating my own framework to deliver services and products. I enjoy innovation and collaboration, so I am interested in different technologies and projects that open me to different possibilities. I am also CTO at {!! Html::link('http://rebel.cat/', "Rebel Team Games") !!}.</p>
		<p>I live in Catalonia (Spain) and you can check me out in {!! Html::link('https://twitter.com/NoelDeMartin', "Twitter") !!} or {!! Html::link('http://www.linkedin.com/pub/noel-de-martin-fernandez/41/a7b/64', "LinkedIn") !!} for more information. If you want to contact me, don't hesitate on {!! Html::link('mailto:noeldemartin@gmail.com', "sending an email") !!}.</p>
		<p>Cheers</p>
	</article>
@stop