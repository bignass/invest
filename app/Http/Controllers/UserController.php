<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function edit()
  {
    if (Auth::user()) {
      $user = User::find(Auth::user()->id);

      if ($user && $user->email_verified_at) {
        return view('pages.user.edit')->withUser($user);
      } else {
        return redirect('/email/verify');
      }
    } else {
      return redirect()->back();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    if (Auth::user()) {
      $user = User::where('id', $id)->findOrFail($id);
      $element = Auth::user()
        ->following->where('other_user_id', $id)
        ->first();

      $isFollowing = Auth::user()->isFollowing($id);
      $followsCount = $this->fcount($id);
      
      return view(
        'pages.user.other_user',
        compact('user', 'isFollowing', 'element', 'followsCount')
      );

      /*
        ['user' => $user],
        ['isFollowing' => Auth::user()->isFollowing($id)]*/
    } else {
      return redirect()->back();
    }
  }

  public function update(Request $request)
  {
    $user = User::find(Auth::user()->id);

    if ($user) {
      $validate = null;

      // Reik patikrinimo nes jei naudosi toki pati email rodys kad jis jau in use
      if (Auth::user()->email === $request['email']) {
        $validate = $request->validate([
          'name' => 'required|min:3',
          'last_name' => 'required|min:3',
          'email' => 'required|email'
        ]);
      } else {
        $validate = $request->validate([
          'name' => 'required|min:3',
          'last_name' => 'required|min:3',
          'email' => 'required|email|unique:users'
        ]);
      }

      if ($validate) {
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];

        if (Auth::user()->email != $request['email']) {
          $user->email_verified_at = null;
        }
        $user->save();

        $request
          ->session()
          ->flash('success', 'Your details have now been updated!');
        return redirect()->back();
      } else {
        return redirect()->back();
      }
    } else {
      return redirect()->back();
    }
  }

  public function fcount($id)
  {
    $myFollows = DB::table('follows') -> where('other_user_id', $id) -> pluck('user_id');
      $skaicius = $myFollows->count();
      
      return $skaicius;
  }
}
