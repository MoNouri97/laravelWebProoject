@extends('layouts.app')
@section('content')
<h1>Edit Post</h1>
<form action="/posts/{{$post->id}}"  method="post">
	@method('PUT')
	{{ csrf_field() }}
	<div class="form-group">
		<label for="title">Title</label>
		<input
		value="{{$post->title}}" 
		type="text" 
		name="title"
		class="form-control" 
		placeholder="title"
		>
	</div>
	<div class="form-group">
		<label for="body">Body</label>
		<textarea name="body" class="form-control" placeholder="body goes here ..." rows="10">{{$post->body}}</textarea>
	</div>
	<button type="submit" class="btn btn-danger">Submit</button>
</form>
@endsection
