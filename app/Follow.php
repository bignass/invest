<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
  public function user()
  {
    // database user 1 -> šitas postas
    return $this->belongsTo(User::class);
  }
}
