<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Admin;
use App\Comment;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
       // $this->middleware('guest',  ['only' => ['show', 'index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('check', 1)->get();   // showed only the post which are acctive/cheked
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

    public function search(Request $request){

        $search = $request->get('search');  
        $posts = Post::where('title','like','%'.$search.'%')->get();   // search in de post table
        return view('posts.index',['posts' => $posts]);
    }

    public function check(Request $request){
        
        $post = Post::find($request->input('check')); 

        if ($post->check){    // if post is checked it will un check the post so its turned off

            $post->check = 0;  
            $post->save();
        }else {              // if post is checked it will check it so it will turn on

            $post->check = 1;
            $post->save();
        }


        return redirect('/admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
       
        

        // create post store in the database
        $post = new Post;   
        $post->title =$request->input('title');
        $post->body =$request->input('body');  
        $post->user_id= Auth::guard('admin')->user()->id; 
        $post->save(); 

        return redirect('/posts')->with('succes', 'Post Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);

        // check for correct user
      

        if ( Auth::guard('admin')->user()){
                 return view('posts.edit')->with('post',$post);
        }
        else{
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);

        // create post store in the database
        $post = Post::find($id);   
        $post->title =$request->input('title');
        $post->body =$request->input('body');   
        $post->save(); 

        return redirect('/posts')->with('succes', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::find($id);

          // check for correct user
          if ( Auth::guard('admin')->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        $post->delete();

        return redirect('/posts')->with('succes', 'Post Removed');
    }
}
