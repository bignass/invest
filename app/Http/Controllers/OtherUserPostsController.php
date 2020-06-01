<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Follow;


class OtherUserPostsController extends Controller
{

    public function posts($id)
    {
        $posts = DB::table('posts') -> where('user_id', $id)->orderBy('created_at', 'desc')->get(); //paima visus postus atbuline tvarka
        $user = User::find($id);
        return view('pages.user.other_user_posts')->with('posts', $posts)->with('user',$user);
    }
}
