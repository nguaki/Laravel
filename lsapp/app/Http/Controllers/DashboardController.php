<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        
        //The following seems to query for all posts that has user_id = $user_id.
        $user    = User::find($user_id);
        
        return view('dashboard')->with('posts',$user->posts);
    }
}
