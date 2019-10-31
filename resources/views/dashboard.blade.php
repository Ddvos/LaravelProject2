@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <h3>Your comments</h3> 

                   
                {{-- @if(Auth::user()->id == $post->user_id) --}}

                    @if(count($comments)> 0)
                    <table class="table table-striped">
                        
                        <tr>
                            <th> Title</th>
                            <th></th>
                            <th></th>
                        </tr>

                       @foreach ($comments as $comment)
                        <tr>
                                <td><a href="/posts/{{$comment->post_id}}">{{$comment->post_id}}</a></td>
                                <td>{{$comment->comment}}</td>       
                            </tr> 
                        @endforeach
                    </table>
                     
                    @else
                         <p>You have no posts</p>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
