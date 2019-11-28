@extends('layouts.app')
@section('content')
<h1 class="display-1">Posts</h1>
@if (count($posts)>0)
<div class="list-group">
	@foreach ($posts as $post)
	<div class="list-group-item">
		<h3><a href="/posts/{{$post->id}}"> {{$post->title}}</a></h3>
		<small>Written on {{$post->created_at}} by {{$post->user->name}} </small>
	</div>
	@endforeach
</div>
@endif
@endsection
