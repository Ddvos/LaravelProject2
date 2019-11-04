<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;
use Auth;

use Session;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        //
        $this->validate($request,array(
            'comment' => 'required|max:2000',
        ));

        // sets the user_id = to admin or user so the comment is stored at the right place 
        if (Auth::guard('admin')->user()){
            $user_id = Auth::guard('admin')->user()->id;
        }
        else{
            $user_id = auth()->user()->id;
        }

         // count comments user made if more then 5 comments made a user is a super user
         $count_posts = Comment::where('user_id', $user_id)->count();

        if( $count_posts > 4){

            $user = User::find($user_id);   
            $user->super_user = true; 
            $user->save();
        }
        
        

        /// store the new comments
        $post = Post::find($post_id);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = $user_id; 
        $comment->approved = true;
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('succes', 'Comment was added');

        return redirect()->to('posts/'.$post_id);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comment =Comment::find($id);

          // check for correct user
          if ( auth()->user()->id !== $comment->user_id){
            return redirect('/dashboard')->with('error', 'Unauthorized Page');
        }
        
        $comment->delete();

        return redirect('/dashboard')->with('succes', 'Comment Removed');
    }
}
