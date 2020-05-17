@extends('layouts.app')

@section('content')
    <div class="container">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        let myChart = document.getElementById('myChart').getContext('2d');

        let profitChart = new Chart(myChart, {
            type: 'line',
            data: {
                labels:['Pirmdienis', 'Antradienis', 'Trečiadienis', 'Ketvirtadienis', 'Penktadienis', 'Šeštadienis', 'Sekmadienis'],
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
            options: {}
        });
    </script>
@endsection