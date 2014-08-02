@extends('_master')


@section('title')
	Edit Song
@stop


@section('content')

	{{ Form::model($song, ['method' => 'post', 'action' => ['BookController@postEdit', $book->id]]) }}

		<h2>Update: {{ $song->name }}</h2>

		<div class='form-group'>
			{{ Form::label('name', 'Title') }}
			{{ Form::text('title') }}
		</div>

		<div class='form-group'>
			{{ Form::label('artist_id', 'Artist') }}
			{{ Form::select('artist_id', $artist, $song->artist_id); }}
		</div>

		<div class='form-group'>
			{{ Form::label('published', 'Published') }}
			{{ Form::text('published') }}
		</div>

		<div class='form-group'>
			{{ Form::label('cover', 'Cover URL') }}
			{{ Form::text('cover') }}
		</div>

		{{ Form::submit('Save') }}

	{{ Form::close() }}

@stop