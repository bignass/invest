@extends('layouts.app')

@section('content')
    <div class="container">
            <div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="text-center" style="font-size: small;">{{$goal ?? 0}} of your goal</p>
            </div>
        @if ($old->count() > 0)
        <div class="row mx-3">
            <canvas class="col" style="max-width: 45%" id="myChart"></canvas>
            <div class="col card">
                <div class="row">
                    <div class="col"><div><table class="table table-hover">
                        <tr>
                            <?php $portfolio = 0;
                            foreach($trades as $i)
                                $portfolio += $i->active_shares * $i->open_price;
                            ?>
                            <th>Portfolio:</th>
                            <th class=" float-right">{{$portfolio}} $</tr>
                        <tr>
                            <?php $gain = 0;
                            foreach($old as $i)
                                $gain += ($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price);
                            ?>
                            <th>Gain:</th>
                            <th class=" float-right">{{$gain}} $</th>
                        </tr>
                        <tr>
                            <?php $best = 0;
                            foreach($old as $i)
                            if(($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price) > $best){
                                $best=($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price);
                            }
                            ?>
                            <th>Best Trade:</th>
                            <th class=" float-right">{{$best}} $</th>
                        </tr>
                        <tr>
                            <?php $worst = $best;
                            foreach($old as $i)
                            if(($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price) < $worst){
                                $worst=($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price);
                            }
                            ?>
                            <th>Worst Trade:</th>
                            <th class=" float-right">{{$worst}} $</th>
                        </tr>
                    </table></div></div>
                    <div class="col"><div>
                        <table class="table table-hover">
                        <tr>
                            <?php $numberOfPTrades=0;
                            foreach($old as $i)
                                if(($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price)>0)
                                    $numberOfPTrades++;
                            ?>
                            <th>No. Of Profitable Trades:</th>
                            <th class=" float-right">{{$numberOfPTrades}}</th>
                        </tr>
                        <tr>
                            <?php $numberOfSTrades=0;
                            foreach($old as $i)
                                if(($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price)<0)
                                    $numberOfSTrades++;
                            ?>
                            <th>No. Of Lose Trades:</th>
                            <th class=" float-right">{{$numberOfSTrades}}</th>
                        </tr>
                        <tr>
                            <?php $avgrpt = $gain/$old->count();  
                            ?>
                            <th>Avg. Return Per Trade:</th>
                            <th class=" float-right">{{number_format((float)$avgrpt, 2, '.', '')}}</th>
                        </tr>
                        <tr>
                            <th>No. Of Active Trades:</th>
                            <th class=" float-right">{{$trades->count()}}</th>
                        </tr>
                    </table></div></div>
                </div>
            </div>
        </div>
        @endif
        <div class="mx-3">
            <a href="/history" class="btn btn-dark form-control">History</a>
        </div>
        <div class="m-3">
            <div class="card">
                <div class="card-body">
                    <div class="row m-2">
                        <input id="stock" maxlength="6" type="text" oninput="this.value = this.value.toUpperCase()" class="m-1 col-1 form-control text-center" value="" placeholder="Stock" required>
                        <input id="date" type="date" class="m-1 col-2 form-control text-center" placeholder="date" required>
                        <input id="nos" type="number" class="m-1 col-2 form-control text-center" placeholder="Number of shares" required>
                        <input id="cps" type="number" class="m-1 col-2 form-control text-right" placeholder="Cost per share" required>
                        <input id="buynotes" type="text" class="m-1 col form-control" placeholder="Why buying?">
                        <a id="buyBTN" href="#" class="m-1 col-1 btn btn-success align-middle">BUY<span class="material-icons align-middle">keyboard_arrow_up</span></a>
                    </div>
                    
                </div>
            </div>
        </div>
            <div id="trade-section">
                <?php $i=0 ?>
                @foreach ($trades as $trade)
                    <div class="m-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-2">
                                    <input type="disabled" class="m-1 col-1 form-control text-center" value="{{$trade->stock}}" readonly>
                                    <input type="date" class="m-1 col-2 form-control text-center" value="{{$trade->open_time}}" readonly>
                                    <input type="number" class="m-1 col-2 form-control text-center" value="{{$trade->active_shares - $trade->number_of_shares_sold}}" readonly>
                                    <input type="text" class="m-1 col-2 form-control text-right" value="{{$trade->open_price}}" readonly>
                                    <input type="text" class="m-1 col form-control" value="{{$trade->buy_notes}}" readonly>
                                </div>
                                    <div id="superb{{$i}}" class="row m-2">
                                    <input type="number" min="1" max="{{$trade->number_of_shares_bought}}"class="m-1 col-1 form-control text-center" placeholder="Shares">
                                    <input type="number" min="0" class="m-1 col-1 form-control text-right" placeholder="Price">
                                    <input type="text" class="m-1 col form-control" placeholder="Why selling?">
                                    <a id="sellBTN" onclick="sell({{$i}},{{$trade->id}})" class="m-1 col-1 btn btn-danger align-middle" href="javascript:;">SELL<span class="material-icons align-middle">keyboard_arrow_down</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/stats.js') }}"></script>
    <script>
        let myChart = document.getElementById("myChart").getContext("2d");
    
            let profitChart = new Chart(myChart, {
                type: "line",
                data: {
                labels: <?php echo "$chartDateArrayJ";?>,
                datasets: [
                    {
                    data: <?php echo "$chartPriceArrayJ";?>,
                    borderColor: "rgba(0,0,0,1)",
                    fill: false,
                    },
                ],
                },
                options: {
                legend: {
                    display: false,
                },
                },
            });
        </script>
    @endsection
    