@extends('layouts.app')
@section('content')
    <h1>Create a new post</h1>
    <form action="/posts" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" placeholder="title">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" class="form-control" placeholder="body goes here ..." rows="8"></textarea>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="coverImage" name="coverImage">
                <label class="custom-file-label" for="coverImage">Ajouter Une Image de Couverture</label>
            </div>
        </div>
        <div class="form-group">
            <label for="tags">tags <small>separate them with ";"</small></label>
            <input type="text" name="tags" class="form-control">
        </div>
        <button type="submit" class="btn btn-danger">Submit</button>

    </form>
@endsection
