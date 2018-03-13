<div id="login">
	@if (Auth::check())
		<div class="alert alert-info" role="alert">
			You are logged in as <b>{!! Auth::user()->username !!}</b> <a href="{!! route('logout') !!}">(Logout)</a>
		</div>
	@else
		<div class="alert alert-info" role="alert">
			Do you have an account? <a href="{!! route('login') !!}">Login</a>
		</div>
	@endif
</div>
