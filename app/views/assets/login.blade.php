<div id="login">
	@if (Auth::check())
		<div class="alert alert-info" role="alert">
			You are logged in as <b>{{ Auth::user()->username }}</b> {{ HTML::linkRoute('logout', '(Logout)') }}
		</div>
	@else
		<div class="alert alert-info" role="alert">
			Do you have an account? {{ HTML::linkRoute('login', 'Login') }}
		</div>
	@endif
</div>