@extends('master')

@section('title');
    Hello World
@stop


@section('content')
    <h1>Welcome!</h1>
    Hello {{ $user['name'] }}!
@stop

