<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $user_id = auth()->user()->id;
         $user = User::find($user_id);
         return view('dashboard')->with('comments', $user->comments);

        // $comments = Comment::all();
        // return view('dashboard')->with('comments',$comments);
    }
}
