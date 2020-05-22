@extends('layouts.app')

@section('content')
<div class="container">
    <head >
    <div class="jumbotron bg-muted ">
        <h1 class="font-weight-bold float-left align-middle">{{$user->name}} {{$user->last_name}}</h1>
        
       
    <div class="float-right align-middle">
    @if ($isFollowing == true)
        <form action="{{'/follow/'.$element->other_user_id}}" method="POST"> 
            {{method_field('DELETE')}}
            {{csrf_field()}} 
            <input type="submit" value="Unfollow" class="btn btn-outline-dark btn-lg border">
        </form>
    @else
        <form action="{{'/follow/create/'.$user->id}}" method="GET">
            
            <input type="submit" value="Follow" class="btn btn-success btn-lg border">
        </form>
    @endif
    <h6 class="text-center">{{$followsCount}} follows </h6>
    </div>
</div>
</head>
</div>
@endsection
