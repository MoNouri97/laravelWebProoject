@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="row">
                        <div class="col-md-4 ">
                            <span class="fas fa-user text-center rounded-circle p-3 text-black-50" style="font-size: 8rem;width:100%"></span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body ">
                                <h5 class="card-title">{{Auth::user()->name}} </h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{Auth::user()->type}}</h6>
                                <p class="card-text">e-mail: {{Auth::user()->email}}</p>
                                <a href="/users/{{Auth::user()->id}}/edit" class="card-link">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(count($posts)>0)

                        <ul class="list-group">
                        @foreach($posts as $post)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="mb-1">{{$post->title}}</h5>
                                        <small>{{$post->created_at}}</small>
                                    </div>
                                    <div class="col-md-4 row">
                                        <a href="/posts/{{$post->id}}/edit" class="btn btn-light col-md-5">Edit</a>
                                        <form action="/posts/{{$post->id}}" method="post" class="col-md-6">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                        @else
                            You Have no Posts !!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- <table class="table table-striped">
    @foreach($posts as $post)
        <tr>
            <td>{{$post->title}}</td>
            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-light">Edit</a></td>
            <td>
                <form action="/posts/{{$post->id}}" method="post">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>

    @endforeach

</table> --}}