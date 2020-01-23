<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ $pagetitle }}</title>

		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com" />
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />

		<!-- Styles -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />

		@stack('headlinks')
		@stack('headstyles')

		<style type="text/css">
		.project input, .project label {color: white;}
    .project input {
      background-color: rgba(255, 255, 255, 0.25);
      border: none;
      transition: 1s ease;
      -webkit-transition: 1s ease; -moz-transition: 1s ease;
      -ms-transition: 1s ease; -o-transition: 1s ease;
    }
    .project input:hover { background-color: white; color: black; }
		</style>

		<!-- Scripts -->
		<script type="text/javascript" src="{{ asset('js/vue.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/three.r92.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/vanta.net.min.js') }}"></script>

		@stack('headscripts')

		<script type="text/javascript">
			window.onload = () => {
				@stack('winload')
			};
		</script>
	</head>
	<body id="bodytag">
		<div id="app">
			<nav class="navbar navbar-expand-md shadow-sm navbar-dark">
				<div class="container">
					<a class="navbar-brand" href="{{ url('/home') }}">
						<h1>@{{ pagetitle }}</h1>
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto"></ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">

						<!-- Authentication Links -->
						@guest
							<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
							@if (Route::has('register'))
							<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
							@endif
						@else
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<div class="dropdown-menu dropdown-menu-right" style="font-size: 100%;" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('addresses.index') }}">Home</a>
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
							</li>
						@endguest
						</ul>
					</div>
				</div>
			</nav>

			@include('layouts.messages')

			<main class="py-4">
				@yield('content')
			</main>
		</div>

		<script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
		<script src="{{ asset('js/popper.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>

		<script type="text/javascript">
			var options = {
				el: '#app',
				data: {
					statuses: true,
    			pagetitle: 'Addresses'
				},
				methods: {},
				computed: {}
			};

	  	VANTA.NET({
			  el: "#bodytag",
			  color: 0x13666b,
			  backgroundColor: 0x0,
			  points: 16.00,
			  maxDistance: 24.00,
			  spacing: 18.00
			});
	  </script>

	  @stack('bodyground')

	  <script type="text/javascript">var app = new Vue(options);</script>
	</body>
</html>