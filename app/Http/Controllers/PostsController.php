<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth',['except'=>['index','show']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// $posts = Post::all();
		$posts = Post::orderBy('created_at', 'desc')->get();
		return view('posts.index')->with('posts', $posts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('posts.createPost');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request) {
		// validate request
		$this->validate($request, [
			'title'		=> 'required',
			'body' 		=> 'required',
			'coverImage'=> 'mimes:jpeg,bmp,png|nullable|max:2000'
		]);

		// handle file
		if ($request->hasFile('coverImage')) {
			// get file name
			$fileNameWithExt = $request->file('coverImage')->getClientOriginalName();
			$fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
			//get ext
			$extension = $request->file('coverImage')->getClientOriginalExtension();
			// name to store
			$nameToStore = $fileName.'_'.time().'.'.$extension;
			// upload image
			$path = $request->file('coverImage')->storeAs('public/cover_images',$nameToStore);
		}else{
			$nameToStore = 'noImage';
		}

		// create a post
		$post = new Post;
		$post->title = $request->input('title');
		$post->body = $request->input('body');
		$post->user_id = auth()->user()->id;
		$post->cover_image = $nameToStore;
		$post->save();
		return redirect('/posts')->with('success', 'Post Created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$post = Post::find($id);
		return view('posts.show')->with('post', $post);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$post = Post::find($id);

		//authentication
		if (auth()->user()->id != $post->user_id){
			return redirect('/posts')->with('error', 'Unauthorized Page');
		}

		return \view('posts.edit')->with('post', $post);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function update(Request $request, $id) {
		$this->validate($request, [
			'title' => 'required',
			'body' => 'required',
			'coverImage'=> 'mimes:jpeg,bmp,png|nullable|max:2000'
		]);
		// create a post
		$post = Post::find($id);

		//authentication
		if (auth()->user()->id != $post->user_id){
			return redirect('/posts')->with('error', 'Unauthorized Page');
		}

		// handle file
		if ($request->hasFile('coverImage')) {
			// get file name
			$fileNameWithExt = $request->file('coverImage')->getClientOriginalName();
			$fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
			//get ext
			$extension = $request->file('coverImage')->getClientOriginalExtension();
			// name to store
			$nameToStore = $fileName.'_'.time().'.'.$extension;
			// upload image
			$path = $request->file('coverImage')->storeAs('public/cover_images',$nameToStore);
		}else{
			$nameToStore = 'noImage';
		}

		$post->title = $request->input('title');
		$post->body = $request->input('body');
		if ($nameToStore != 'noImage') {
			$post->cover_image = $nameToStore;
		}
		$post->save();
		return redirect('/posts')->with('success', 'Post Updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$post = Post::find($id);

		//authentication
		if (auth()->user()->id != $post->user_id){
			return redirect('/posts')->with('error', 'Unauthorized Page');
		}

		if($post->cover_image){
			Storage::delete('/public/cover_images/'.$post->cover_image);
		}

		$post->delete();
		return redirect('/posts')->with('success', 'Post Removed');

	}
}
