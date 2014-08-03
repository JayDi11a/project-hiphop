@extends('_master')


@section('head')
	<link rel="stylesheet" href="projecthiphop.css" type="text/css">
@stop

@section('title')
	All your Songs
@stop

@section('content')

	<h2>Songs</h2>

	<div>
		View as:
		<a href='/song/?format=json' target='_blank'>JSON</a> | 
		<a href='/song/?format=pdf' target='_blank'>PDF</a>
	</div>

	<div>
		<a href='/song/create'>+ Add a song</a>
	</div>


	@if(trim($query) != "")
		<p>You searched for <strong>{{{ $query }}}</strong></p>

		@if(count($songs) == 0)
			<p>No matches found</p>
		@endif

	@endif

	@foreach($songs as $title => $song)

		<section>
			<img class='cover' src='{{ $song['cover'] }}'>

			<h2>{{ $song['title'] }}</h2>

			<p>			
			{{ $song['artist']->name }} {{ $song['published'] }}
			</p>

			<p>
				@foreach($song['tags'] as $tag) 
					{{ $tag->name }}
				@endforeach
			</p>

			<a href='{{ $song['cover'] }}'>Purchase this book...</a>
			<br>
			<a href='/song/edit/{{ $song->id }}'>Edit</a>
		</section>

	@endforeach

@stop