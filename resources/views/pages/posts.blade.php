@extends('layouts.app')

@section('content')
<div class="container">
    
    <form action="posts/create" method="GET">
        
        <div class="input-group mb-3">
            <input type="text" name="body" class="form-control" placeholder="What's on your mind?" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">   
                @csrf
              <button class="btn btn-success" type="submit">Post</button>
            </div>
          </div>
    </form>

@if (count($posts) > 0)
    @foreach ($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    @if($post->user->id == Auth::user()->id)
                    <div class="col">
                        <p>{{$post->user->name}} {{$post->user->last_name}}</p>
                    </div>
                    <div class="col">
                        <form class="float-right" action="{{'/posts/'.$post->id}}" method="POST">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                        </form>
                    </div>
                    @else
                    <div class="col">
                        <a href="/user/{{$post->user->id}}">{{$post->user->name}} {{$post->user->last_name}}</a>
                    </div>
                    <div class="col">
                        <form class="float-right" action="{{'/'}}" method="">
                            
                            <input type="submit" value="Unfollow" class="btn btn-outline-dark btn-sm">
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-body">{{$post->body}}</div>
            @if ($post->user->id == Auth::user()->id)
                @csrf
            @endif
        </div>
    @endforeach
    
@else
    
<h3 class="text-center"> There are no posts 🙄 </h3>        
    
@endif
</div>

@endsection
