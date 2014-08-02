@extends('_master')


@section('title')
	View Tag
@stop


@section('content')

	<h2>Tag: {{ $tag->name }}</h2>

	<div>
	Created: {{ $tag->created_at }}
	</div>

	<div>
	Last Updated: {{ $tag->updated_at }}
	</div>

	{{---- Edit ----}}
	<a href='/tag/{{ $tag->id }}/edit'>Edit</a>

	{{---- Delete -----}}
	{{ Form::open(['method' => 'DELETE', 'action' => ['TagController@destroy', $tag->id]]) }}
		<a href='javascript:void(0)' onClick='parentNode.submit();return false;'>Delete</a>
	{{ Form::close() }}

@stop