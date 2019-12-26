@extends('layouts.app')
@section('content-f')
    <div class="text-center">
        <h1 class="display-1 ">{{$post->title}}</h1>
        <small>Written on {{$post->created_at}}<br>
            by {{$post->user->name}} 
        </small>
        @auth
        <a href='#' onclick="followWriter(event,{{$post->user->id}})" id="follow" class="badge badge-success">
            @if ($followed)
            unFollow
            @else
            Follow
            @endif
        </a>
        @endauth
    </div>
    <hr>
    <div class="row">
        @if ($post->cover_image != 'noImage')
            <img style="background-image: url('/storage/cover_images/{{$post->cover_image}}');
                    background-size: cover;
                    background-position:center;
                    width: 100%;
                    height:300px">
        @else
            <div class="noImage" style="width: 100% ; height:300px"></div>
        @endif
    </div>
@endsection
@section('content')
    <p>{{$post->body}}</p>
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
