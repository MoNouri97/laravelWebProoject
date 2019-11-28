@extends('layouts.app') @section('content')
    <a href="/posts" class="mt-3 mb-3 btn btn-outline-primary">Back</a>
    <h1 class="display-1">{{$post->title}}</h1>
    <p>{{$post->body}}</p>
    <hr/>
    <small>Written on {{$post->created_at}} by {{$post->user->name}} </small>
    <hr>
    @if(!Auth::guest())
        @if(auth()->user()->id === $post->user_id)
            <div class="row">
                <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                <form action="/posts/{{$post->id}}" method="post">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endif
    @endif
@endsection
