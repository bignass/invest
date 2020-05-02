<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
    $follow = new Follow();
    $follow->user_id = Auth::user()->id;
    $follow->other_user_id = $id; // žmogus kurį pafollowina
    $follow->save();

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Follow  $Follow
   * @return \Illuminate\Http\Response
   */
  public function destroy($follow)
  {
    $data = Follow::all()
      ->where('user_id', Auth::user()->id)
      ->where('other_user_id', $follow)
      ->first();
    $data->delete();
    return redirect()->back();
  }
}
