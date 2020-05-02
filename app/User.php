<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Follow;

class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'last_name', 'email', 'password'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime'
  ];

  public function posts()
  {
    // Database user 1 -> 0-* Postų
    return $this->hasMany(Post::class);
  }

  public function following()
  {
    return $this->hasMany(Follow::class);
  }

  public function isFollowing($id)
  {
    $user = Follow::all()
      ->where('user_id', $this->id)
      ->where('other_user_id', $id)
      ->count();
    if ($user > 0) {
      return true;
    }
    return false;
  }
}
