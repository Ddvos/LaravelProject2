@extends('layouts.app')

@section('content')
    <h1>Maak hier een nieuwe post aan</h1>
    <p>wellkom  {{Auth::guard('admin')->user()->name}}</p> 

    {!! Form::open(['action'=>'PostController@store','method'=>'POST']) !!}
     <div class="form-group">
         {{Form::label('title','Title')}}
         {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Title'])}}
     </div>
     <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['class'=>'form-control', 'placeholder'=>'type hier je inhoud'])}}
        </div>
        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}


@endsection