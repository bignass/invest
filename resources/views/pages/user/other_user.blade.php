@extends('layouts.app')

@section('content')
<style>
    img {
  border-radius: 50%;
  border: 1px solid #ddd;
  max-width: 15%;
  height: auto;
}
.followai {
    position: absolute;
    right: 25%;
    top:20%;
}

.about{
    position: absolute;
    left: 40%;
    right: 35%;
    top:20%;
    bottom: 67%;
    font-style: italic;
    
}
</style>

<div class="container">       
    <div class="jumbotron bg-muted ">
        <div>
        <img  src={{ asset('storage/uploads/users/'. $user->img) }} alt="image" enctype="multipart/form-data">
        
        </div>
        <div class="about"><h6>{{ $user->about }}</h6></div>
        <h1 class="font-weight-bold float-left align-middle">{{$user->name}} {{$user->last_name}}</h1>
        
        
       
    <div class="followai">
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
    <h5 class="text-center">{{$followsCount}} followers </h5>
    </div>
</div>

<a href="/other_user_posts/{{$user['id']}}" class="btn btn-dark form-control">Go to {{ $user->name }} posts</a>
</div>
@endsection
