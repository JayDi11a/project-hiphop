@extends('_master')


@section('title')
	All the tags
@stop


@section('content')

	<h2>Tags</h2>


	<a href='/tag/create'>+ Add a new tag</a>

	<br><br>

	@foreach($tags as $tag)

		<div>
			<a href='/tag/{{ $tag->id }}'>{{ $tag->name }}</a>
		</div>

	@endforeach

@stop