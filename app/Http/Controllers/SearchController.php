<?php

namespace App\Http\Controllers;


use App\Post;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Follow;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('layouts.app');
    }
    
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $users = DB::table('users')->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('last_name','LIKE','%'.$request->search.'%')->get();
            if($users)
            {
                $i=0;
                foreach($users as $key => $user)
                {
                    if($i<=5){
                    $output.='<a class="card" href="/user/'.$user->id . '">'.

                    
                    // vieta foto
                    '<div class="b">'.
                    '<td>'.$user->name . ' </td>'.
                    '<td>' . $user->last_name.'</td>'.
                    '</div>'.
                    

                    '</a>';
                    $i++;
                    }
                }
                return Response($output);
                
                
            }
        }
    }
}
?>
<style>

.b{
  
  float: left;
  color: #f2f2f2;
  text-align: left;
  padding: 10px 10px;
  padding-left:10px;
  text-decoration: none;
  font-size: 17px;
  color: black;
}

.b:hover {
    background-color: #DCDADA;
    color: black;
    font-weight: bold;
}



    </style>

