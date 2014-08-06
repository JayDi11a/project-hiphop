@extends('_master')

@section('title')
	A Tribe Called Quest
@stop

@section('content')

	<br><br>

	{{ Form::open(array('action' => 'SongController@getIndex', 'method' => 'GET')) }}

		{{ Form::label('query','Search for a songs related to "Electric Relaxation":') }} &nbsp;
		{{ Form::text('query') }} &nbsp;
		{{ Form::submit('Search!') }}

	{{ Form::close() }}


@stop