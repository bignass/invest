<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // gali pažiūrėkt tik prisijungę vartotojai
    // if (Auth::user()) {
    //   //$user = User::find($user_id);
    //   /*$user = Auth::user()
    //     ->following->select('follows.*', 'id')
    //     ->get();*/
    //   $posts = Post::all(); //paima visus postus atbuline tvarka

    //   //return $user;

    //   return view('pages.posts')->with('posts', $posts);
    // } else {
    //   return redirect('/login');
    // }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $post = new Post();
    $post->user_id = Auth::user()->id;
    $post->body = $request->body;
    $post->save();

    return redirect()->back();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post)
  {
    echo 'show';
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Post $post)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy($post)
  {
    $data = Post::findOrFail($post);
    $data->delete();
    return redirect()->back();
  }
}
