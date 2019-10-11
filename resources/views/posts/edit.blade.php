@extends('layouts.app')

@section('content')
    <h1>Maak de gewenste wijzigingen</h1>
    <p> Edit pagina</p> 

    {!! Form::open(['action'=> ['PostController@update', $post->id],'method'=>'POST']) !!}
     <div class="form-group">
         {{Form::label('title','Title')}}
         {{Form::text('title',$post->title,['class'=>'form-control', 'placeholder'=>'Title'])}}
     </div>
     <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body',$post->body,['class'=>'form-control', 'placeholder'=>'type hier je inhoud'])}}
        </div>
        {{Form:: hidden('_method','PUT')}}
        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}


@endsection