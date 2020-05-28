<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChangeUserInfoController extends Controller
{
    //
    public function index()
    {
        //return "asda";
        
        return view('pages.changeInfo');
    }

    public function update(Request $request)
  {
      $user = User::find(Auth::user()->id);
      $user->about = $request->input('about');
    if($request->hasfile('foto')){
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension(); //getting image extension
        $filename = time(). '.' .$extension;
        $file->move('storage/uploads/users/', $filename);
        $user->img = $filename;
    }
    $user->save();

    return redirect('/')->with('user',$user);

  }
}
