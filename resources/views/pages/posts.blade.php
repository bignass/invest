@extends('layouts.app')

@section('content')

@if($suggestions != NULL)
<div class="float-right pr-5 mr-1">
    <div class="card mb-3 box-shadow ">
    <div class="card-header text-center">
        <h5><dt>Suggestions</dt></h5>
    </div>
    
    <table style="max-width:300px">
        @foreach($suggestions as $user)
        <tr style="border: 1px solid #ddd">
            
           <td class=" align-middle " style="width: 250px">
               
        
            <h5><a style="color:black;" href="/user/{{$user['id']}}">{{ $user['first'] }} {{ $user['second'] }}</a></h5>
            </td>
            <td class="align-middle " style="width: 60px">
                <form action="{{'/follow/create/'.$user['id']}}" method="GET">
                    <input type="submit" value="Follow" class="btn btn-success btn-sm border">
                </form>
            
           </td>
        </tr>
        @endforeach
    </table>
</div>
    </div>
    
</div>@endif

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
        
</div>




@endsection
