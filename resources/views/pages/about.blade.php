@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <p> Hi I am Dominique</p> 

    @if (Auth::guard('admin')->user())
        <p> Hi I admin</p> 
        @else
        <p> Hi I user</p> 
    @endif
@endsection

