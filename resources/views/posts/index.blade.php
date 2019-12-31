
@extends('layouts.app')
@section('hero')
    
@component('includes.hero')
@slot('title')
Blog Posts 
@endslot
@slot('subTitle')
It is my business to know what other people don’t know </br> <small >Sherlock Holmes</small>
@endslot
@endcomponent  
@endsection

@section('content')
{{-- <h1 class="display-1" style="font-weight: 900;text-align: center">Posts</h1> --}}
<hr>
    @if (count($posts)>0)
    <h1 class=" font-weight-bold">Latest</h1>
<div class="row">
    @foreach ($posts as $post)
    <div class="d-flex flex-column  mb-0 bd-highlight col-md-4">
        <div class="">
            <div class="post-entry" style="background: #fff;box-shadow: 0px 0px 25px -19px black;" >
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
                    <span class="post-meta">{{$post->created_at}} &bullet; By <a href="/users/{{$post->user_id}}">{{$post->user->name}}</a></span>
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


{{-- @section('title')
    Blog Posts
@endsection

@section('subTitle')
    Read , Write , Simply Create
@endsection --}}