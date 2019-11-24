<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>Laravel</title>
    </head>
    <body>
			@include('includes.nav')
			@include('includes.messages')
			<div class="container">
				@yield('content')
			</div>

		<script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
