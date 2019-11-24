@extends('layouts.app')
@section('content')
<h1>Create a new post</h1>
<form action="/posts"  method="post">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" class="form-control" placeholder="title">
	</div>
	<div class="form-group">
		<label for="body">Body</label>
		<textarea name="body" class="form-control" placeholder="body goes here ..." rows="10"></textarea>
	</div>
	<button type="submit" class="btn btn-danger">Submit</button>
</form>
@endsection
