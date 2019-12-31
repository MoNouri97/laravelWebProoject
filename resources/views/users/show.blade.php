@extends('layouts.app')
@section('content')
<div class="card">

    <div class="row">
        <div class="col-md-4 ">
            <span class="fas fa-user text-center rounded-circle p-3 text-black-50"
                style="font-size: 8rem;width:100%"></span>
        </div>
        <div class="col-md-8">
            <div class="card-body ">
                <h5 class="card-title">{{$user->name}} </h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$user->type}}</h6>
								<p class="card-text">e-mail: {{$user->email}} <br>
								Posts: {{count($posts)}}
								</p>
                @auth
                @if (Auth::user()->id ==$user->id)
                <a href="/users/{{$user->id}}/edit" class="card-link">Edit</a>
                @endif
                @endauth
            </div>
        </div>
    </div>
</div>
<hr>
@if (count($posts)>0)
<div class="row">
    @foreach ($posts as $post)
    <div class="d-flex flex-column  mb-0 bd-highlight col-md-4">
        <div class="">
            <div class="post-entry" style="background: #fff;box-shadow: 0px 0px 25px -19px black;">
                <a href="posts/{{$post->id}}" class="d-block " style="height: 250px;overflow: hidden">
                    @if ($post->cover_image != 'noImage')
                    <img class="img-fluid" src="/storage/cover_images/{{$post->cover_image}}">
                    @else
                    <div class="noImage d-flex align-items-center text-center" style="width: 100% ; height:250px">


                    </div>
                    @endif
                </a>
                <div class="post-text  p-4">
                    @foreach ($post->tags as $item)
                    <p class="badge badge-warning ">{{$item.' '}} </p>
                    @endforeach
                    <span class="post-meta">{{$post->created_at}} &bullet; By <a
                            href="/users/{{$post->user_id}}">{{$post->user->name}}</a></span>
                    <h3><a href="posts/{{$post->id}}">{{$post->title}} </a></h3>
                    <p>{{ substr($post->body ,0, 100) }}... </p>
                    <p><a href="posts/{{$post->id}} " class="readmore">Read more</a></p>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>
@else
No Posts Found !
@endif
@endsection
