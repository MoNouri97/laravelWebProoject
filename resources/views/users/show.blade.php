@extends('layouts.app')
@section('content')
<div class="card">

	<div class="row">
		<div class="col-md-4 ">
			<span class="fas fa-user text-center rounded-circle p-3 text-black-50" style="font-size: 8rem;width:100%"></span>
		</div>
		<div class="col-md-8">
			<div class="card-body ">
				<h5 class="card-title">{{$user->name}} </h5>
				<h6 class="card-subtitle mb-2 text-muted">{{$user->type}}</h6>
			<p class="card-text">e-mail: {{$user->email}}</p>
				<a href="/users/{{$user->id}}/edit" class="card-link">Edit</a>
			</div>
		</div>
	</div>
</div>
@endsection