@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($goal != null)    
            <div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="text-center" style="font-size: small;">{{$goal}} of your goal</p>
            </div>
        @endif

        <div class="row m-4">
            <canvas class="col" style="max-width: 45%" id="myChart"></canvas>
            <div class="col card">
                <div class="row">
                    <div class="col"><div><table class="table table-hover">
                        <tr>
                            <th>Portfolio:</th>
                            <th class=" float-right">310$</th>
                        </tr>
                        <tr>
                            <th>Gain:</th>
                            <th class=" float-right">2.99%</th>
                        </tr>
                        <tr>
                            <th>1 year gain:</th>
                            <th class=" float-right">2.99%</th>
                        </tr>
                        <tr>
                            <th>Best Trade:</th>
                            <th class=" float-right">+9.01$</th>
                        </tr>
                        <tr>
                            <th>Worst Trade:</th>
                            <th class=" float-right">-0$</th>
                        </tr>
                    </table></div></div>
                    <div class="col"><div><table class="table table-hover">
                        <tr>
                            <th>Avg. Annual Return:</th>
                            <th class=" float-right">35.2%</th>
                        </tr>
                        <tr>
                            <th>Avg. Trade Length:</th>
                            <th class=" float-right">31d.</th>
                        </tr>
                        <tr>
                            <th>Max. Draw Down:</th>
                            <th class=" float-right">0%</th>
                        </tr>
                        <tr>
                            <th>Profit:</th>
                            <th class=" float-right">9.01$</th>
                        </tr>
                        <tr>
                            <th>No. Of Trades:</th>
                            <th class=" float-right">1</th>
                        </tr>
                    </table></div></div>
                </div>
            </div>
        </div>
        <div class="m-4">
            <div class="card">
                <div class="card-body">
                    <div class="row m-2">
                            <input type="text" class="m-1 col-1 form-control text-center" value="" placeholder="Stock" required>
                            <input type="date" class="m-1 col-2 form-control text-center" placeholder="date" required>
                            <input type="number" class="m-1 col-2 form-control text-center" placeholder="Number of shares" required>
                            <input type="number" class="m-1 col-2 form-control text-right" placeholder="Cost per share" required>
                            <input type="text" class="m-1 col form-control" placeholder="Why buying?"></input>
                            <button type="submit" class="m-1 col-1 btn btn-success align-middle">BUY<span class="material-icons align-middle">keyboard_arrow_up</span></button>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="m-4">
            <div class="card">
                <div class="card-body">
                    <div class="row m-2">
                        <input type="disabled" class="m-1 col-1 form-control text-center" value="APPL" readonly>
                        <input type="date" class="m-1 col-2 form-control text-center" value="2020-01-08" readonly>
                        <input type="number" class="m-1 col-2 form-control text-center" value="1" readonly>
                        <input type="text" class="m-1 col-2 form-control text-right" value="300.99$" readonly>
                        <input type="text" class="m-1 col form-control" value="Gera kaina, max deal'as" readonly></input>
                    </div>
                    <div class="row m-2">
                        <input type="number" class="m-1 col-1 form-control text-center" placeholder="Shares"></input>
                        <input type="number" class="m-1 col-1 form-control text-right" placeholder="Price"></input>
                        <input type="text" class="m-1 col form-control" placeholder="Why selling?"></input>
                        <a class="m-1 col-1 btn btn-danger align-middle" href="#">SELL<span class="material-icons align-middle">keyboard_arrow_down</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-4">
            <div class="card" style="background: rgba(56, 193, 114, 0.25) !important;">
                <div class="card-body">
                    <div class="row m-2">
                        <input type="disabled" class="m-1 col-1 form-control text-center" value="APPL" readonly>
                        <input type="date" class="m-1 col-2 form-control text-center" value="2020-02-08" readonly>
                        <input type="number" class="m-1 col-2 form-control text-center" value="1" readonly>
                        <input type="text" class="m-1 col-2 form-control text-right" value="300.99$" readonly>
                        <input type="text" class="m-1 col form-control" value="Gera kaina, max deal'as" readonly></input>
                    </div>
                    <div class="row m-2">
                        
                        <input type="number" class="m-1 col-1 form-control text-center" value="-1" readonly></input>
                        <input type="text" class="m-1 col-1 form-control text-right" value="310$" readonly></input>
                        <input type="text" class="m-1 col form-control" value="Apple sux, buying google" readonly></input>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; }
    </style>
    <script>

        let myChart = document.getElementById('myChart').getContext('2d');

        let profitChart = new Chart(myChart, {
            type: 'line',
            
            data: {
                labels:['', '', '', '', '', '', ''],
                datasets:[{
                    label:'',
                    data:[
                        1,
                        2,
                        1,
                        1.5,
                        3,
                        -1,
                        0
                    ],
                    borderColor: 'rgba(0,0,0,1)',
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false,
                }
            }
        });


        let btn = document.querySelector("#app > main > div > div:nth-child(3) > div > div > div > a")
        btn.addEventListener('click', buy);
        function buy(e){
            e.preventDefault();
            if()
        }
    </script>
@endsection