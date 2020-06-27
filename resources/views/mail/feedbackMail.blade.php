@extends('layouts.mail')
@section('title')
Feedback Email
@endsection
@section('content')
	title	: {{$title}}
	<hr>
	{{$body}}
	<hr>
	from	: {{$email}}
@endsection