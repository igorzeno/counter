@extends('layouts.app')

@section('content')
    <div class="flex justify-center visit">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <br><br><br><br>
            <div id="chartContainer2" style="height: 300px; width: 100%;">
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer",
                {
                    title: {
                        text: "Посещаемость по времени суток"
                    },
                    axisX:{
                        stripLines:[
                            {
                                minimum: 0,
                                maximum: 24,
                                startValue:10,
                                endValue:11,
                                color:"#d8d8d8"
                            }
                        ],
                        valueFormatString: "####"
                    },
                    data: [
                        {
                            type: "splineArea",
                            color: "rgba(83, 223, 128, .6)",
                            dataPoints:  <?php echo $res;?>
                        }
                    ]
                });
            chart.render();

            var chart2 = new CanvasJS.Chart("chartContainer2",
                {
                    title: {
                        text: "Суммарные показатели"
                    },
                    axisY:{
                        //     minimum: 50,
                        maximum: 80
                    },
                    data: [
                        {
                            type: "column",
                            dataPoints: [
                                { x: 100, y: 71 },
                                { x: 200, y: 55},
                                { x: 300, y: 50 },
                                { x: 400, y: 65 },
                                { x: 500, y: 95 },
                                { x: 600, y: 68 },
                                { x: 700, y: 28 },
                                { x: 800, y: 34 },
                                { x: 900, y: 14}
                            ]
                        }
                    ]
                });

            chart2.render();
        }

    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection

