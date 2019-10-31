@extends('layouts.app')

@section('content')
    <h1>Dit is mijn portfolio hieronder vind je mijn werk </h1>
    <br>

    <div class="col-md-4">
        <form action="/search" method="get">
            <div class="input-group">
                <input type="search" name="search" class="form-control">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>
        </form>
    </div>
    <br>
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

    @if (Auth::guard('admin')->user())
  <p>Hallo Admin</p>
    @else
     <p>Hallo guest</p>
@endif
@endsection

