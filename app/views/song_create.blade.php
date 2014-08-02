@extends('_master')

@section('title')
	Add a new song
@stop

@section('content')

	<h1>Add a New Song</h1>


	{{ Form::open(array('url' => '/song/create', 'method' => 'POST')) }}

		<div class='form-group'>
			{{ Form::label('artist_id', 'Artist') }}
			{{ Form::select('artist_id', $artists); }}
		</div>

		<div class='form-group'>
			{{ Form::label('title') }} 
			{{ Form::text('title') }}
		</div>

		<div class='form-group'>
			{{ Form::label('published', 'Published (YYYY)') }} 
			{{ Form::text('published') }}
		</div>

		<div class='form-group'>
			{{ Form::label('cover','Cover URL') }} 
			{{ Form::text('cover') }}
		</div>


		{{ Form::submit('Add') }}

	{{ Form::close() }}


@stop