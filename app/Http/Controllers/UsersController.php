<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

		/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$users = User::all();
		// \dd($users);
		return view('users.index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('users.create');
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
			'name' => 'required',
			'email' => 'required',
			'password' => 'required',
			'password_confirmation' => 'required',
			'type' => ['required', Rule::in(['reader', 'writer'])]
		]);

		$user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = $request->input('password');
		$user->type = $request->input('type');
		$user->save();
		return redirect('/users')->with('success', 'User Created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$user = User::find($id);
		return view('users.show')->with('user',$user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$user = User::find($id);
		return view('users.edit')->with('user',$user);
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
		// validate request
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required',
			'type' => 'required'
		]);

		$user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->type = $request->input('type');
		$user->save();
		return redirect('/')->with('success', 'User Updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user = User::find($id);
		$posts = $user->posts;
		//authentication
		if (auth()->user()->id != $user->user_id && auth()->user()->type != 'admin') {
			return redirect('/users')->with('error', 'Unauthorized Page');
		}

		//delete all the associated posts
		foreach ($posts as $p)
			$p->delete();

		$user->delete();
		return redirect('/users')->with('success', 'User Removed');
	}

/**
 * toggle admin rights to a user
 */
	public function toggleAdmin($id) {
		if (auth()->user()->type != 'admin')
			return redirect('/users')->with('error', 'Unauthorized Page');
		$user = User::find($id);
		if ($user->type != 'admin')
			$user->type = 'admin';
		else
			$user->type = 'writer';

		$user->save();
		return redirect('/users')->with('success', 'User Updated');
	}

	/**
	 * add a user to the authenticated user following.
	 *
	 * @param Request $request
	 * @return Json
	 */
	public function follow(Request $request){
		$this->validate($request, [
			'id' => ['required','integer']
		]);
		$id = $request->input('id');
		$toAdd = 0;
		$operation = "added to";
		$following = auth()->user()->following;

		//array is not empty ?
		if($following == NULL ){
			$following[0] = $id;
		}else {
			$found = array_search($id,$following);
			if ($found || $found===0) {
				// remove 
				$operation = "removed from";
				array_splice($following, $found,1); 
			}	else{
				// add a new following
				array_push($following, $id);
			}
		}
		auth()->user()->following = $following;
		auth()->user()->save();
		return response()->json([
			'success'=>'Writer is successfully '.$operation.' following',
			'operation'=> $operation
		]);
	}


}
