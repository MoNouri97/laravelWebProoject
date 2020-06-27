@extends('layouts.mail')
@section('title')
New Article Was Posted 
@endsection
@section('content')
	a new post from {{$writer}} whom you are following, <br>
	the title of the post is : {{$title}}
	<hr>
	check it out now : <a href="http://sharedinfo.test/posts/{{$id}}"> Click Here</a>
@endsection