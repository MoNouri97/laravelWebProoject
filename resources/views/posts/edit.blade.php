@extends('layouts.app')
@section('content')
<h1>Edit Post</h1>
<form action="/posts/{{$post->id}}"  method="post" enctype="multipart/form-data">
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
	<div class="form-group">
		<div class="custom-file">
			<input type="file" class="custom-file-input" id="coverImage" name="coverImage">
			<label class="custom-file-label" for="coverImage">Ajouter Une Image de Couverture</label>
		</div>
	</div>
	<button type="submit" class="btn btn-danger">Submit</button>
</form>
@endsection
