@extends('_master')

@section('title')
	Welcome to Project Hip Hop
@stop

@section('content')

	<br><br>

	{{ Form::open(array('action' => 'SongController@getIndex', 'method' => 'GET')) }}

		{{ Form::label('query','Search for a song:') }} &nbsp;
		{{ Form::text('query') }} &nbsp;
		{{ Form::submit('Search!') }}

	{{ Form::close() }}


@stop