@extends('layouts.app')

@section('content')

<style>
     img {
  border-radius: 50%;
  border: 1px solid #ddd;
  max-width: 9%;
  height: auto;
}
</style>


<div class="container">
    
<div class="row">
<div class="col-10"><h2 class="font-weight-bold">{{ $user->name }} {{ $user->last_name }} posts</h2></div>
<div class="col-2"><a href="/user/{{ $user->id }}" class="btn btn-success">Back to profile</a></div>
</div>
@if (count($posts) > 0)
    @foreach ($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <p>{{ $post->created_at }}</p>
                    @if($post->user_id == Auth::user()->id)
                    <div class="col">
                        <form class="float-right" action="{{'/posts/'.$post->id}}" method="POST">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                        </form>
                    </div>
                    @else
                    <p>{{ $post->created_at }}</p>
                    @endif
                </div>
            </div>
            <div class="card-body">{{$post->body}}</div>
            @if ($post->user_id == Auth::user()->id)
                @csrf
            @endif
        </div>
    @endforeach
    
@else
    
<h3 class="text-center"> There are no posts 🙄 </h3>        
    
@endif
        </div>
        
</div>




@endsection
