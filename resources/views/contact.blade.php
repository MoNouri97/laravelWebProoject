@extends('layouts.app')
@section('hero')

@component('includes.hero')
@slot('title')
Contact Us
@endslot
@slot('subTitle')
We Can't Wait To Hear What You Think !! 
@endslot
@endcomponent
@endsection
@section('content')
<h1></h1>
<form action="/contact" method="post">
    @method('Post')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="email" >{{ __('E-Mail Address') }}</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
						@auth
						value="{{ Auth::user()->email}}" 
						@endauth		
						required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" placeholder="title">
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" class="form-control" placeholder="body goes here ..." rows="10"></textarea>
    </div>
    
    <button type="submit" class="btn btn-danger">Send</button>
</form>
@endsection
