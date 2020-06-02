<?php

namespace App\Http\Controllers;

use Auth;
use App\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (Auth::check()) {
      $trades = Trade::all()
        ->where('user', Auth::user()->id)->where('active_shares', '>',0)
        ->sortByDesc('id');
      $old = Trade::all()
        ->where('user', Auth::user()->id)->whereNotNull('number_of_shares_sold');
      
      $j=0;
      $chartPriceArray = array();
      $chartDateArray = array();

      for($i=365; $i>=0; $i--){
        $chartPrices = Trade::all()
        ->where('user', Auth::user()->id)
        ->whereNotNull('number_of_shares_sold')
        ->where('close_time', '=', date('Y-m-d',strtotime(date("Y-m-d", time()) . " - $i day")));
        
        $chartDates = Trade::all()
        ->where('user', Auth::user()->id)
        ->whereNotNull('number_of_shares_sold')
        ->where('close_time', '=', date('Y-m-d',strtotime(date("Y-m-d", time()) . " - $i day")))->pluck('close_time')->first();

        $prsum = 0;
        foreach($chartPrices as $o){
          $prsum = ($o->close_price * $o->number_of_shares_sold)-($o->open_price * $o->number_of_shares_sold);
        }
        
        if($chartDates){
        $chartDateArray[$j] = $chartDates;
        $chartPriceArray[$j] = $prsum;
        $j++;
        }
      }
      $chartDateArrayJ = json_encode($chartDateArray);
      $chartPriceArrayJ = json_encode($chartPriceArray);
      return view('pages.user.stats')->with('trades', $trades,)->with('old', $old)->with('chartDateArrayJ',$chartDateArrayJ)
      ->with('chartPriceArrayJ',$chartPriceArrayJ);
    } else {
      return view('pages.home');
    }
  }
  public function history()
  {
    $trades = Trade::all()
    ->where('user', Auth::user()->id)->whereNotNull('number_of_shares_sold')
    ->sortByDesc('id');

    $j=0;
      $chartPriceArray = array();
      $chartDateArray = array();
    for($i=365; $i>=0; $i--){
      $chartPrices = Trade::all()
      ->where('user', Auth::user()->id)
      ->whereNotNull('number_of_shares_sold')
      ->where('close_time', '=', date('Y-m-d',strtotime(date("Y-m-d", time()) . " - $i day")));
      
      $chartDates = Trade::all()
      ->where('user', Auth::user()->id)
      ->whereNotNull('number_of_shares_sold')
      ->where('close_time', '=', date('Y-m-d',strtotime(date("Y-m-d", time()) . " - $i day")))->pluck('close_time')->first();

      $prsum = 0;
      foreach($chartPrices as $o){
        $prsum = ($o->close_price * $o->number_of_shares_sold)-($o->open_price * $o->number_of_shares_sold);
      }
      
      if($chartDates){
      $chartDateArray[$j] = $chartDates;
      $chartPriceArray[$j] = $prsum;
      $j++;
      }
    }
    $chartDateArrayJ = json_encode($chartDateArray);
    $chartPriceArrayJ = json_encode($chartPriceArray);
    
    return view('pages.user.history')->with('trades', $trades)->with('chartDateArrayJ',$chartDateArrayJ)
    ->with('chartPriceArrayJ',$chartPriceArrayJ);
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    if (
      $request->input('stock') == '' ||
      $request->input('nos') == '' ||
      $request->input('date') == '' ||
      $request->input('cps') == ''
      ) {
        return 'no';
    } else {
      $trade = new Trade();
      $trade->user = Auth::user()->id;
      $trade->stock = $request->input('stock');
      $trade->number_of_shares_bought = $request->input('nos');
      $trade->active_shares = $request->input('nos');
      $trade->open_time = $request->input('date');
      $trade->open_price = $request->input('cps');
      $trade->buy_notes = $request->input('notes');
      $trade->save();
    }
    return 'created';
  }

  public function sell(Request $request){
    if ($request->input('id') == '' || $request->input('nos') == '' || $request->input('pps') == '')
    return 'no';
    else{
    $trade = Trade::all()->where('id', $request->input('id'))->first();
      if($request->input('nos')>$trade->number_of_shares_bought)
      return 'tooBig';
    }

    if($request->input('nos')==$trade->number_of_shares_bought)
      $this->updateEqual($request->input('id'), $request->input('nos'), $request->input('pps'), $request->input('notes'));

    if($request->input('nos')<$trade->number_of_shares_bought)
      $this->updateNotEqual($request->input('id'), $request->input('nos'), $request->input('pps'), $request->input('notes'));
    return 'created';
  }

  public function updateEqual($id, $nos, $pps, $notes){
    $trade = Trade::all()->where('id', $id)->first();
      $trade->active_shares = 0;
      $trade->number_of_shares_sold = $nos;
      $trade->close_time = date("Y-m-d");
      $trade->close_price = $pps;
      $trade->close_notes = $notes;
      $trade->close_notes = $notes;
      $trade->save();
  }

  public function updateNotEqual($id, $nos, $pps, $notes){
    $trade = Trade::all()->where('id', $id)->first();
      $trade->active_shares -= $nos;
      $trade->save();
    
    $newTrade = new Trade;
    $newTrade->user = $trade->user;
    $newTrade->stock = $trade->stock;
    $newTrade->active_shares = 0;
    $newTrade->number_of_shares_bought = $trade->number_of_shares_bought;
    $newTrade->number_of_shares_sold = $nos;
    $newTrade->open_time = $trade->open_time;
    $newTrade->close_time = date("Y-m-d");
    $newTrade->open_price = $trade->open_price;
    $newTrade->close_price = $pps;
    $newTrade->buy_notes = 	$trade->buy_notes;
    $newTrade->close_notes = $notes;
    $newTrade->save();

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
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}