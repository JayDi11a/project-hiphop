@extends('_master')

@section('title')
	Search (with Ajax!)
@stop


@section('content')

	<h1>Search (with Ajax!)</h1>

	<label for='query'>Search:</label>
	<input type='text' id='query' name='query' value='hiphop'><br><br>

	<button id='search-json'>Search and get JSON back</button><br><br>
	<button id='search-html'>Search and get HTML back</button><br><br>

	<div id='results'></div>

@stop

@section('footer')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="/js/search.js"></script>
@stop