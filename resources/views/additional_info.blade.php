@extends('layouts.app')

@section('content')

<style>

.card {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  display: grid;
  font-family: 'Trebuchet MS', sans-serif;
}
.container{
    position: relative;
    justify-content: center;
    align-items: center;
    top: 30%;
    text-align: center;
    
}

</style>
<div class="container">
    <head>

    </head>
    <body>
    <form action="/addInfo" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    

    <div class="form-group ">
        <div class="text-center">
        <label class="custom-label"><h1>Write about yourself</h1></label>
        </div>
        <input type="text" name="about" class="form-control card" placeholder="I am...">
    
    </div>
    <div class="container" style="align-items: center; width:40%">
    <label class="custom-label"><h1>Add your profile photo</h1></label>
    <div class="card">
    <div class="input-group">
        <div class="custom-file">
        <input type="file" name="foto" class="custom-file-input card">
        <label class="custom-file-label">Choose photo</label>
        </div>
    </div>
    </div>
    <label class="custom-label"><h1> </h1></label>
    <button type="submit" name="submit" class="btn btn-success btn-block"> Save Data </button>
    <h2>or</h2>
    <button type="submit" name="submit" class="btn btn-info btn-block "> Skip this step </button>
    </form>
    </body>
</div>
