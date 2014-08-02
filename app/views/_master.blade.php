<!doctype html>
<html>
<head>

	<title>@yield('title','A Tribe Called Quest')</title>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/styles/projecthiphop.css" type="text/css">

	@yield('head')

</head>

<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<a href='/'><img class='logo' src='<?php echo URL::asset('/images/archive-logo-white.png'); ?>' alt='Project Hip Hop Logo'></a>

	@if(Auth::check())
		<a href='/logout'>Log out {{ Auth::user()->email; }}</a><br><br>
		<a href='/song'>View all Books</a> | 
		<a href='/tag'>View all Tags</a>  |
		<a href='/song/search'>Search (with Ajax!)</a>
	@else 
		<a href='/signup'>Sign up</a> or <a href='/login'>Log in</a>
	@endif

	@yield('content')

	@yield('body')

	@yield('footer')

</body>

</html>