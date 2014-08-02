@extends('_master')

@section('title')
	Create a new Tag
@stop


@section('content')

	<h1>Create a Tag</h1>

	{{ Form::open(array('action' => 'TagController@store')) }}

		<div>
			{{ Form::label('name','Tag Name') }}
			{{ Form::text('name') }}
		</div>

		<br><br>
		{{ Form::submit('Add Tag') }}

	{{ Form::close() }}

@stop