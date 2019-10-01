@extends('layouts.app')

@section('content')
    <h1>Hier staan de nieuwe video'sss</h1>
    <p> Hi I am Dominiqueee</p> 

    @if(count($posts) > 0)
        @foreach ($posts as $post)
            <div class="well">
            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>gescheven op {{$post->created_at}}</small>
            </div>
        @endforeach
    @else
        <p>Er zijn geen video's</p>
    @endif
@endsection

