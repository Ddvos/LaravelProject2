@extends('layouts.app')

@section('content')

    <a href="/posts" class="btn btn-default">Ga terug</a>
    <h1>{{$post->title}}</h1>
    <div>
        {{$post->body}}
    </div>

    <hr>

    <small>Written on {{$post->created_at}}</small>

    <hr>
    {{--is only visisble when you  login as Admin --}}
    
        @if(Auth::guard('admin')->user())
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' =>['PostController@destroy', $post->id],'method'=>'POST','class'=>'pull-right'])!!}

                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    

      {{-- show comments --}}
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              @foreach($post->comments as $comment)
                    <div class="comment">
                        <p>Comment: {{$comment->comment}}</p>
                    </div>
              @endforeach
          </div>
      </div>
        {{-- form for comments --}}
        <div class="row">
            <div id="comment-from" class="col-md-8 col-md-offset-2">

                {{Form::open(['route'=> ['comments.store', $post->id, 'method'=>'POST' ]]) }}
                    <div class="row">
                        <div class="col-md-12">
                                {{Form::label('comment',"Comment:")}}
                                {{Form::textarea('comment',null, ['class'=>'form-control'])}}

                                {{Form::submit('Add Comment', ['class'=>'btn btn-success'])}}
                        </div>
                    </div>


                {{Form::close()}}
            </div>
        </div>

@endsection
