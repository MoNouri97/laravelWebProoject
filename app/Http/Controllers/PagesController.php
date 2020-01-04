<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\feedbackMail;

class PagesController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth', ['only' => ['contact','contactShow']]);
    }
    
    public function Index()
    {
        return redirect('/posts');
        // return view('pages.index');
    }

    public function contactShow(Request $request)
    {
        return view("contact");
    }

    public function contact(Request $request)
    {
        // validate request
		$this->validate($request, [
			'title' => 'required',
			'body' => 'required',
        ]);

        $title = $request->input('title');
		$body = $request->input('body');
		$email = $request->input('email');
       
        //send mail 
        Mail::to("email@SharedInfo.test")
        ->queue(new feedbackMail(
            $title,
            $body,
            $email
        ));

        return redirect('/posts')->with('success', 'Email Sent');
		
    }
}
