@extends('layouts.app')

@section('content')

<style>
     img {
  border-radius: 50%;
  border: 1px solid #ddd;
  max-width: 15%;
  height: auto;
}


</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">


                    <div class="text-center mb-4">
                        <div class="mb-5">
                        <img src={{ asset('storage/uploads/users/'. $user->img) }} alt="image" enctype="multipart/form-data">
                        
                        </div>
                        @if($user->about == NULL)
                        <div class="mb-3"><h4>Write about yourself! :)</h4></div>
                        @else
                        <div class="mb-3"><h4>About you: </h4><h6>{{ $user->about }}</h6></div>
                        @endif
                        <a href="/changeInfo" type="submit" class="btn btn-success">
                            Update photo and info
                        </a>
                    </div>

                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                        
                        @if(session('success'))
                        <div class="alert alert-success text-center" role="alert">{{session('success')}}</div>
                        @endif
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                            <input id="name" value="{{$user['name']}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                            <input id="last_name" value="{{$user['last_name']}}" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" value="{{$user['email']}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Details') }}
                                </button>
                            </div>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
