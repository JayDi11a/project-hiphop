@extends('_master')


@section('title')
	Edit Tag
@stop


@section('content')

	{{ Form::model($tag, ['method' => 'put', 'action' => ['TagController@update', $tag->id]]) }}

		<h2>Update: {{ $tag->name }}</h2>

		<div class='form-group'>
			{{ Form::label('name', 'Tag Name') }}
			{{ Form::text('name') }}
		</div>

		{{ Form::submit('Update') }}

	{{ Form::close() }}

@stop