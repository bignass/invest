<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    //$this->middleware(['auth', 'verified']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    /*
     *Patikrina ar vartotojas prisijungęs, ir jei prisijungęs redirectina į kitą home page
     *kur gali matyti savo postus ir ką followina
     */
    if (Auth::user()) {
      return redirect('/posts');
      //return view('pages.home.home_user');
    } else {
      return view('pages.home.home');
    }
  }
}
