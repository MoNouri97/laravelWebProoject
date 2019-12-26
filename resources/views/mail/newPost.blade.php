@extends('layouts.mail')
@section('content')
		<div class="container">
			<h1 class="display-1">
				New Article Was Posted 
			</h1>
			<p>
				a new post from {{$writer}} whom you are following, <br>
				the title of the post is : {{$title}}
				<hr>
				check it out now : <a href="http://webproject.test/posts/{{$id}}"> Click Here</a>
			</p>
		</div>
@endsection