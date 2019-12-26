@extends('layouts.app')
@section('content')
    <h1 class="display-1">Posts</h1>
    @if (count($posts)>0)
        <div class="list-group">
            @foreach ($posts as $post)
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            @if ($post->cover_image != 'noImage')
                                <img src="/storage/cover_images/{{$post->cover_image}}" style="width: 100%">
                            @else
                                <div class="noImage" style="width: 100% ; height:100%"></div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3><a href="/posts/{{$post->id}}"> {{$post->title}}</a></h3>
                            <small>Written on {{explode(" ",$post->created_at)[0]}} by {{$post->user->name}} </small>
                            <br>
                            @foreach($post->tags as $tag)
                                <span class="badge badge-secondary">{{$tag}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>no posts found !</p>
    @endif
@endsection
