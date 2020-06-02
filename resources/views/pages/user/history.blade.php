@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <div class="progress" style="height: 10px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <p class="text-center" style="font-size: small;">{{$goal ?? 0}} of your goal</p>
    </div>
    @if ($trades->count() > 0)
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
                            foreach($trades as $i)
                                $gain += ($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price);
                            ?>
                            <th>Gain:</th>
                            <th class=" float-right">{{$gain}} $</th>
                        </tr>
                        <tr>
                            <?php $best = 0;
                            foreach($trades as $i)
                            if(($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price) > $best){
                                $best=($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price);
                            }
                            ?>
                            <th>Best Trade:</th>
                            <th class=" float-right">{{$best}} $</th>
                        </tr>
                        <tr>
                            <?php $worst = $best;
                            foreach($trades as $i)
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
                            foreach($trades as $i)
                                if(($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price)>0)
                                    $numberOfPTrades++;
                            ?>
                            <th>No. Of Profitable Trades:</th>
                            <th class=" float-right">{{$numberOfPTrades}}</th>
                        </tr>
                        <tr>
                            <?php $numberOfSTrades=0;
                            foreach($trades as $i)
                                if(($i->number_of_shares_sold * $i->close_price)-($i->number_of_shares_sold * $i->open_price)<0)
                                    $numberOfSTrades++;
                            ?>
                            <th>No. Of Lose Trades:</th>
                            <th class=" float-right">{{$numberOfSTrades}}</th>
                        </tr>
                        <tr>
                            <?php $avgrpt = $gain/$trades->count();  
                            ?>
                            <th>Avg. Return Per Trade:</th>
                            <th class=" float-right">{{number_format((float)$avgrpt, 2, '.', '')}}</th>
                        </tr>
                        <tr>
                            <th>No. Of Closed Trades:</th>
                            <th class=" float-right">{{$trades->count()}}</th>
                        </tr>
                    </table></div></div>
                </div>
            </div>
        </div>
        @endif
    <div class="mx-3">
        <a href="/" class="btn btn-dark form-control">Active Trades</a>
    </div>
    @foreach ($trades as $trade)
        @if (($trade->close_price - $trade->open_price) >= 0)
            <div class="m-3">
                <div class="card" style="background: rgba(56, 193, 114, 0.25) !important;">
                    <div class="card-body">
                        <div class="row m-2">
                            <input type="disabled" class="m-1 col-1 form-control text-center" value="{{$trade->stock}}" readonly>
                            <input type="date" class="m-1 col-2 form-control text-center" value="{{$trade->open_time}}" readonly>
                            <input type="number" class="m-1 col-2 form-control text-center" value="{{$trade->number_of_shares_bought}}" readonly>
                            <input type="text" class="m-1 col-2 form-control text-right" value="{{$trade->open_price}} $" readonly>
                            <input type="text" class="m-1 col form-control" value="{{$trade->buy_notes}}" readonly>
                        </div>
                        <div class="row m-2">
                            <input type="number" class="m-1 col-1 form-control text-center" value="{{$trade->number_of_shares_sold}}" readonly>
                            <input type="text" class="m-1 col-1 form-control text-right" value="{{$trade->close_price}} $" readonly>
                            <input type="text" class="m-1 col form-control" value="{{$trade->close_notes}}" readonly>
                        </div>
                        
                    </div>
                </div>
            </div>
        @else
        <div class="m-3">
            <div class="card" style="background: rgba(227, 52, 47, 0.25) !important;">
                <div class="card-body">
                    <div class="row m-2">
                        <input type="disabled" class="m-1 col-1 form-control text-center" value="{{$trade->stock}}" readonly>
                        <input type="date" class="m-1 col-2 form-control text-center" value="{{$trade->open_time}}" readonly>
                        <input type="number" class="m-1 col-2 form-control text-center" value="{{$trade->number_of_shares_bought}}" readonly>
                        <input type="text" class="m-1 col-2 form-control text-right" value="{{$trade->open_price}} $" readonly>
                        <input type="text" class="m-1 col form-control" value="{{$trade->buy_notes}}" readonly>
                    </div>
                    <div class="row m-2">
                        <input type="number" class="m-1 col-1 form-control text-center" value="{{$trade->number_of_shares_sold}}" readonly>
                        <input type="text" class="m-1 col-1 form-control text-right" value="{{$trade->close_price}} $" readonly>
                        <input type="text" class="m-1 col form-control" value="{{$trade->close_notes}}" readonly>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
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
