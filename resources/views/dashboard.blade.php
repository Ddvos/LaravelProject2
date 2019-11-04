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
                            <th> Post id</th>
                            <th> Comment</th>
                            <th>@if($super_user) Delete  @endif </th>
                        </tr>

                       @foreach ($comments as $comment)
                        <tr>
                                <td><a href="/posts/{{$comment->post_id}}">{{$comment->post_id}}</a></td>
                                <td>{{$comment->id}}</td>   
                                
                                <td>@if($super_user) 
                                    {!!Form::open(['action' =>['CommentsController@destroy', $comment->id],'method'=>'DELETE','class'=>'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                    @endif
                                </td> 
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
