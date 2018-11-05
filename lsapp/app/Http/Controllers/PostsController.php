<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;  //Post is a class from Model which has access to data from DB.
use DB;   //This is case when decided not to use Eloquence.

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Post::all() returns data in JSON format.
        //$posts = Post::all();
        
        //Sorted by title ascending order.
        //$posts = Post::orderBy('title','asc')->get();     //By ascending order
        //$posts = DB::select('SELECT * FROM posts');       //No Eloquence. Use SQL
        //$posts = Post::where('title','Post Two')->get();  //where title = 'Post Two'
        
        //$posts = Post::orderBy('title','desc')->get();   //By descending order
        //$posts = Post::orderBy('title','desc')->take(1)->get();  //Put limit per select
        $posts = Post::orderBy('created_at','desc')->paginate(10);   //Pagination. # of items per page
        
        //Here the controller plays mediator role by
        //getting data from Model and calls View with data.
        //Fantastic!!!
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required'
        ]);
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        
        //Since auth is turned on, the current logged in user's id can be obtained.
        $post->user_id = auth()->user()->id;
        
        $post->save();
        
        //success is $_SESSION['success']
        return redirect('/posts')->with('success', 'Post Create');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::find($id);
        
        //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //Note two parameters
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required'
        ]);
        
        $post = Post::find($id); //Note: this is not a new object.
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        
        //success is $_SESSION['success']
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =  Post::find($id);
        
        //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
