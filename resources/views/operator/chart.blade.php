@extends('layout.master')

@section('title','Operator Chart')

@section('content')

    <section class="content-header">
        <h1> Operator Chart
        </h1>
    </section>

    <script>
        $(document).ready(function () {
            var myBarChart;
            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext('2d');
            Chart.defaults.global.defaultFontColor = 'black';
            Chart.defaults.global.responsive = true;
            Chart.defaults.global.defaultFontSize = 14;

            $('#operator-result-chart').hide();
            $('#operator-chart').on('submit',function (e) {
                e.preventDefault();
                $('#operator-result-chart').show();
                var date=$('#reservation').val();

                $.ajax({
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: 'operator-chat',
                    data:{'date':date},
                    success:function (response) {
                        var label_dates=[];
                        var mpt=[];
                        var ooreedoo=[];
                        var telenor=[];
                        var amount=[];

                        for(var i =0; i < response.length; i++)
                        {
                            label_dates.push(response[i].date);
                            mpt.push(response[i].operator.MPT);
                            ooreedoo.push(response[i].operator.Ooredoo);
                            telenor.push(response[i].operator.Telenor);
                            amount.push(response[i].total);
                        }

                            var data = {
                                labels: label_dates,
                                datasets: [{
                                    label: "MPT",
                                    fill: false,
                                    lineTension: 0.1,
                                    // backgroundColor: "rgba(225,0,0,0.4)",
                                    borderColor: "red", // The main line color
                                    borderCapStyle: 'square',
                                    borderDash: [], // try [5, 15] for instance
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "black",
                                    pointBackgroundColor: "white",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 8,
                                    pointHoverBackgroundColor: "yellow",
                                    pointHoverBorderColor: "brown",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 4,
                                    pointHitRadius: 10,
                                    // notice the gap in the data and the spanGaps: true
                                    data: mpt,
                                    spanGaps: true
                                },
                                    {
                                        label: "Ooredoo",
                                        fill: true,
                                        lineTension: 0.1,
                                        // backgroundColor: "rgba(167,105,0,0.4)",
                                        borderColor: "rgb(167, 105, 0)",
                                        borderCapStyle: 'butt',
                                        borderDash: [],
                                        borderDashOffset: 0.0,
                                        borderJoinStyle: 'miter',
                                        pointBorderColor: "white",
                                        pointBackgroundColor: "black",
                                        pointBorderWidth: 1,
                                        pointHoverRadius: 8,
                                        pointHoverBackgroundColor: "brown",
                                        pointHoverBorderColor: "green",
                                        pointHoverBorderWidth: 2,
                                        pointRadius: 4,
                                        pointHitRadius: 10,
                                        // notice the gap in the data and the spanGaps: false
                                        data:ooreedoo,
                                        spanGaps: true,
                                        hidden:false
                                    },
                                    {
                                        label: "Telenor",
                                        fill: true,
                                        lineTension: 0.1,
                                        // backgroundColor: "rgba(167,10,0,0.4)",
                                        borderColor: "rgb(16, 105, 0)",
                                        borderCapStyle: 'butt',
                                        borderDash: [],
                                        borderDashOffset: 0.0,
                                        borderJoinStyle: 'miter',
                                        pointBorderColor: "white",
                                        pointBackgroundColor: "black",
                                        pointBorderWidth: 1,
                                        pointHoverRadius: 8,
                                        pointHoverBackgroundColor: "brown",
                                        pointHoverBorderColor: "yellow",
                                        pointHoverBorderWidth: 2,
                                        pointRadius: 4,
                                        pointHitRadius: 10,
                                        data:telenor,
                                        spanGaps: false,
                                        hidden:false
                                    }
                                ]
                            };
                            var options = {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        },
                                        xAxes:[{
                                            // stacked: false,
                                            ticks:{
                                                max:3,
                                                min:0,
                                                padding:20
                                                // stepSize:1,
                                            }
                                        }],
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Amount',
                                            fontSize: 12
                                        }
                                    }]
                                }
                            };
                        // myBarChart.destroy();
                        if(myBarChart)
                            myBarChart.destroy();
                        myBarChart = new Chart(ctx, {
                                    type: 'line',
                                    responsive: true,
                                    data: data,
                                    options: options
                                });
                        // });
                    }
                });

            });
        });
    </script>

    <div class="row ">
        <div class="col-md-6" style="margin-top:20px;margin-left: 20px;margin-right: 20px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Date picker</h3>
                </div>
                <div class="box-body">
                    <form  id="operator-chart">
                        {{ csrf_field() }}
                        <div class="form-group">

                            <label>Date range:</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="reservation" name="date">
                            </div>
                            <input type="submit" name="" class="btn btn-success" value="Submit" style="margin-top:20px">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>



    <div class="row"  id="operator-result-chart" style="margin-left: 20px;margin-right: 20px">
        <div class="box box-primary1">
            <div class="box-body">
                <canvas id="barChart" ></canvas>
            </div>
        </div>
    </div>



@endsection