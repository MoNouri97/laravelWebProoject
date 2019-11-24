@extends('layouts.app')
@section('content')
<h1 class="display-1">Posts</h1>
@if (count($posts)>0)
<div class="list-group">
	@foreach ($posts as $item)
	<div class="list-group-item">
		<h3><a href="/posts/{{$item->id}}"> {{$item->title}}</a></h3>
		<small>Written on {{$item->created_at}}</small>
	</div>
	@endforeach
</div>
@endif
@endsection
