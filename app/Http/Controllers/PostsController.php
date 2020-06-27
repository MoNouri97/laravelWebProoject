<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Mail\newPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class PostsController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth', ['except' => ['index', 'show','indexTag']]);
		$this->middleware('writer',['only' => ['create','store']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// $posts = Post::all();
		$posts = Post::orderBy('created_at', 'desc')->paginate(6);
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
			'title' => 'required',
			'body' => 'required',
			'coverImage' => 'mimes:jpeg,bmp,png|nullable|max:2000'
		]);

		// handle file
		if ($request->hasFile('coverImage')) {
			// get file name
			$fileNameWithExt = $request->file('coverImage')->getClientOriginalName();
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			//get ext
			$extension = $request->file('coverImage')->getClientOriginalExtension();
			// name to store
			$nameToStore = $fileName . '_' . time() . '.' . $extension;
			// upload image
			$path = $request->file('coverImage')->storeAs('public/cover_images', $nameToStore);
		} else {
			$nameToStore = 'noImage';
		}

		// create a post
		$post = new Post;
		$post->title = $request->input('title');
		$post->body = $request->input('body');
		$post->user_id = auth()->user()->id;
		$writerName = auth()->user()->name;
		$post->cover_image = $nameToStore;
		if ($request->input('tags'))
			$post->tags = explode(";", $request->input('tags'));
		$post->save();

		//send mail to followers
		$queryResults = User::where('following','like','%'.$post->user_id.'%')->get();
		if (count($queryResults)>0) {
			Mail::to($queryResults)
			->send(new newPost(
				$post->id,
				$post->title,
				$writerName
			));
		}
			
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
		if ($post == NULL) {
			return \abort(404);
		}
		$ret = view('posts.show')->with('post', $post);
		
		if (auth()->check()) {	
			// check if the user is following the writer
			$following = auth()->user()->following;
			if ($following != NULL) {
				$found = array_search($post->user_id,$following);
				if ($found || $found===0) {
					$ret->with('followed',TRUE);
				}	else{
					$ret->with('followed',FALSE);
				}
			}else{
				$ret->with('followed',FALSE);
			}
		}

		return $ret;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$post = Post::find($id);
		if ($post == NULL) {
			return \abort(404);
		}
		//authentication
		if (auth()->user()->id != $post->user_id) {
			return redirect('/posts')->with('error', 'Unauthorized Page');
		}
		//making tags into a string
		$tags = $post->tags;
		$st = "";
		foreach ($tags as $key => $val) {
			if ($key != 0)
				$st .= ";";
			$st .= $val;
		}

		return \view('posts.edit')->with('post', $post,)->with('tags', $st);
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
			'coverImage' => 'mimes:jpeg,bmp,png|nullable|max:2000'
		]);
		// create a post
		$post = Post::find($id);

		//authentication
		if (auth()->user()->id != $post->user_id) {
			return redirect('/posts')->with('error', 'Unauthorized Page');
		}

		// handle file
		if ($request->hasFile('coverImage')) {
			// get file name
			$fileNameWithExt = $request->file('coverImage')->getClientOriginalName();
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			//get ext
			$extension = $request->file('coverImage')->getClientOriginalExtension();
			// name to store
			$nameToStore = $fileName . '_' . time() . '.' . $extension;
			// upload image
			$path = $request->file('coverImage')->storeAs('public/cover_images', $nameToStore);
		} else {
			$nameToStore = 'noImage';
		}

		$post->title = $request->input('title');
		$post->body = $request->input('body');
		if ($nameToStore != 'noImage') {
			$post->cover_image = $nameToStore;
		}
		if ($request->input('tags'))
			$post->tags = explode(";", $request->input('tags'));
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
		if (auth()->user()->id != $post->user_id) {
			return redirect('/posts')->with('error', 'Unauthorized Page');
		}

		if ($post->cover_image) {
			Storage::delete('/public/cover_images/' . $post->cover_image);
		}

		$post->delete();
		return redirect('/posts')->with('success', 'Post Removed');
	}

	/**
	 * Return the posts in a specific tag
	 * @param string tag
	 */
	public function indexTag(Request $request){
		$tag = $request->input('tags');
		$tagsArray = explode(';',$tag);
		$query = Post::orderBy('created_at', 'desc');
		for ($i=0; $i < count($tagsArray) ;$i++) {
			$query = $query->orWhere('tags', 'like', '%'.$tagsArray[$i].'%');
		}
		$posts = $query->paginate(6);
		// \dd($posts);
		return view('posts.index')->with('posts', $posts);
		

	}
}
