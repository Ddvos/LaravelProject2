@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/posts/create" class=" btn btn-primary">Create a new post</a>
                    <br>
                   <h3>Your Blog posts</h3>

                   @if(count($posts)> 0)
                    <table class="table table-striped">
                        
                        <tr>
                            <th> Title</th>
                            <th></th>
                            <th></th>
                            <th>Visibility</th>
                        </tr>

                        @foreach ($posts as $post)
                        <tr>
                                <td>{{$post->title}}</td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a></td>
                                <td>
                                    {!!Form::open(['action' =>['PostController@destroy', $post->id],'method'=>'POST','class'=>'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete',['class' =>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                                <td>
                                  @if ($post->check)
                                    <form method="POST" action="/postcheck">
                                        @csrf <!-- {{ csrf_field() }} -->
                                        <input type="hidden" name="check" value="{{$post->id}}">
                                        {{-- <input type="hidden" value={{csrf_token}} name="token"> --}}
                                         <input type="submit" value="off" class="btn btn-success">
                                    </form>
                                    @else
                                        <form method="POST" action="/postcheck">
                                            @csrf <!-- {{ csrf_field() }} -->
                                            <input type="hidden" name="check" value="{{$post->id}}">
                                            {{-- <input type="hidden" value={{csrf_token}} name="token"> --}}
                                             <input type="submit" value="on" class="btn btn-danger">
                                        </form>
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

            {{-- show all users incl filter opptions --}}
            <div class="card">
                    <div class="card-header">Dashboard Admin overview users</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        
                        <br>
                       <h3>Users</h3>

                     
    
                       @if(count($users)> 0)
                        <table class="table table-striped">
                            
                            <tr>
                                <th> ID</th>
                                <th> name</th>
                                <th> email</th>
                            </tr>
    
                            @foreach ($users as $user)
                            <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                             <p>There are no users</p>               
                       @endif
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
