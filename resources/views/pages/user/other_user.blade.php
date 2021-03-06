@extends('layouts.app')

@section('content')
<div class="container">       
    <div class="jumbotron bg-muted ">
        <div>
        <img  src={{ asset('storage/uploads/users/'. $user->img) }} alt="image" enctype="multipart/form-data">
        
        </div>
        <div class="about"><h6>{{ $user->about }}</h6></div>
        <h1 class="font-weight-bold float-left align-middle">{{$user->name}} {{$user->last_name}}</h1>
        
    <div class="followai">
    @if ($isFollowing == true)
        <form action="{{'/follow/'.$element->other_user_id}}" method="POST"> 
            {{method_field('DELETE')}}
            {{csrf_field()}} 
            <input type="submit" value="Unfollow" class="btn btn-outline-dark btn-lg border">
        </form>
    @else
        <form action="{{'/follow/create/'.$user->id}}" method="GET">
            
            <input type="submit" value="Follow" class="btn btn-success btn-lg border">
        </form>
    @endif
    <h5 class="text-center">{{$followsCount}} followers </h5>
    </div>
</div>

<a href="/other_user_posts/{{$user['id']}}" class="btn btn-dark form-control mt-0">User posts</a>

@if ($trades->count() <= 0)
    <h3 class="text-center m-3"> There are no trades in user's history 📉 </h3>        
@else
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
<style>
    img {
  border-radius: 50%;
  border: 1px solid #ddd;
  max-width: 15%;
  height: auto;
}
.followai {
    position: absolute;
    right: 25%;
    top:20%;
}

.about{
    position: absolute;
    left: 40%;
    right: 35%;
    top:20%;
    bottom: 67%;
    font-style: italic;
    
}
</style>
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
