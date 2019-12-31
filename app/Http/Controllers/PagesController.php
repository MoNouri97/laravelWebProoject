<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function Index()
    {
        return redirect('/posts');
        // return view('pages.index');
    }
}
