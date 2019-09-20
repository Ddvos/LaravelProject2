@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if(count($services)>0)
        <ul class="list-group">
            @foreach($services as $serivce)
                <li class="list-group-item">{{$serivce}}</li>
            @endforeach
        </ul>
    @endif
    <p> This the services page</p>
@endsection
