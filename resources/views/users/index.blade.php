@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Users
            <a href="/users/create" class="btn btn-outline-success float-right">Create User</a>
        </div>
        <div class="card-body">

            @if (count($users)>0)
                <div class="list-group">
                    @foreach ($users as $user)
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3><a href="/users/{{$user->id}}"> {{$user->name}}</a></h3>
                                    <small>{{$user->email}}</small><br>
                                    <small>{{$user->type}}</small>
                                </div>
                                <div class="col-md-4 row">
                                    <a type="submit" href="/users/{{$user->id}}"
                                       class="btn btn-outline-danger col-md-12"
                                       onclick="event.preventDefault();
                                               document.getElementById('delete-form-{{$user->id}}').submit();">
                                        Delete
                                    </a>
                                    <form id="delete-form-{{$user->id}}" action="/users/{{$user->id}}" method="post"
                                    >
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                    </form>
                                    @if ($user->type != 'admin')
                                        <a href="/users/{{$user->id}}/admin" class="btn btn-outline-success col-md-12">
                                            Make Admin
                                        </a>
                                    @else
                                        <a href="/users/{{$user->id}}/admin" class="btn btn-success col-md-12">
                                            Revoke Admin
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>no users found !</p>
            @endif
        </div>
    </div>
@endsection