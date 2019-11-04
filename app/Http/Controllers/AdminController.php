<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Admin;
use App\Post;
use App\User;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function store(Request $request)
    {
        if ($request->has('check') === 'yes') {
            // checked

            return view('pages.about');
            // $post = Post::find($id);
            // $post->check = 1;
            // $post->save();
        } else {
            // unchecked
        }
    }
    public function index()
    {
       
        $posts = Post::all();
        $users = User::all();
    //    $user_id = auth()->user()->id;
    //    $user = User::find($user_id);  
        return view('admin')->withPosts($posts)->withUsers($users);
    }

   // Auth::guard('admin')->user())
}
