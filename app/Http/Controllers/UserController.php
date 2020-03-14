<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function edit()
  {
    if (Auth::user()) {
      $user = User::find(Auth::user()->id);

      if ($user) {
        return view('pages.user.edit')->withUser($user);
      } else {
        return redirect()->back();
      }
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
          'email' => 'required|email'
        ]);
      } else {
        $validate = $request->validate([
          'name' => 'required|min:3',
          'email' => 'required|email|unique:users'
        ]);
      }

      if ($validate) {
        $user->name = $request['name'];
        $user->email = $request['email'];

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
}
