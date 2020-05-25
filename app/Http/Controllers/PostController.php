<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Follow;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //gali pažiūrėkt tik prisijungę vartotojai
    if (Auth::user()) {
      
      $users = DB::table('follows') -> where('user_id', Auth::user()->id) -> pluck('other_user_id');
      
      $users->push(Auth::user()->id);
      
      $posts = Post::whereIn('user_id', $users)->orderBy('id', 'desc')->get(); //paima visus postus atbuline tvarka
      
//return $this->suggest_to_follow();

      $suggestions =  $this->suggest_to_follow();

      return view('pages.posts')->with('posts', $posts)->with('suggestions',$suggestions);
    } else {
      return redirect('/login');
    }
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

 // counts how many people follow user
  public function fcount($id)
  {
    $myFollows = DB::table('follows') -> where('other_user_id', $id) -> pluck('user_id');
      $skaicius = $myFollows->count();
      
      return $skaicius;
  }
// returns follows count of each user
public function followers_count()
{
  $users_id = DB::table('users')->select('id')->get();
  $i = 0;
  foreach($users_id as $user)
  {
    $count = $this->fcount($user->id);
    $follow_count[$i]["id"] = $user->id;
    $follow_count[$i]["count"] = $count;
    $i++;
  }
  return $follow_count;
  
}

// returns filtered users(id) to suggest
  public function filtered_suggests()
  {
    $followers_count = $this->followers_count();
    $columns = array_column($followers_count, 'count');
    array_multisort($columns, SORT_DESC, $followers_count); // sort by followers count, from biggest to smallest number
    $a=0;
    for($i = 0; $i < count($followers_count); $i++)
    {
      if($followers_count[$i]["id"] != Auth::user()->id) // cheking if user isn't himself
      {
        
        if(!DB::table('follows') -> where('user_id', Auth::user()->id) -> where('other_user_id', $followers_count[$i]["id"]) -> exists()) // checking if user isn't already followed
        {
          $suggesting_users[] = $followers_count[$i]["id"];
          $a=1;
        }
      }
    }
    if($a==1)
    return $suggesting_users;
  }

  // reuturns top5 suggested users name and lastname
  public function suggest_to_follow()
  {
    $users_id = $this->filtered_suggests();
    if($users_id == NULL)
    {return 0;}
    $count = 5;
    if(count($users_id) < 5) // if suggested users number is less than 5, for goes till suggested users number
    {
      $count = count($users_id);
    }  
    for($i = 0; $i < $count; $i++) // top5 suggestions
    {
      $suggestions[$i]["id"] = $users_id[$i];
      $name = DB::table('users') -> where('id', $users_id[$i]) -> value('name');
      $lastName = DB::table('users') -> where('id', $users_id[$i]) -> value('last_name');
      
      $suggestions[$i]["first"] = $name;
      $suggestions[$i]["second"] = $lastName;
    }
    
    return $suggestions;
  }

 
  
}
