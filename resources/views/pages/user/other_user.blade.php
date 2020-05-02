@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="text-center">{{$user->name}} {{$user->last_name}}</h1>
    @if ($isFollowing == true)
        <form action="{{'/follow/'.$element->other_user_id}}" method="POST"> 
            {{method_field('DELETE')}}
            {{csrf_field()}} 
            <input type="submit" value="Unfollow" class="btn btn-outline-dark btn-sm">
        </form>
    @else
        <form action="{{'/follow/create/'.$user->id}}" method="GET">
            
            <input type="submit" value="Follow" class="btn btn-success btn-sm">
        </form>
    @endif

</div>
@endsection
