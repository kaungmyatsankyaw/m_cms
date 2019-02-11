@extends('layout.master')

@section('title','Ooreedoo')

@section('content')

    <section class="content-header">
        <h1> Ooreedoo
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

            $('#ooreedoo-result-chart').hide();
            $('#ooreedoo-chart').on('submit',function (e) {
                e.preventDefault();
                $('#ooreedoo-result-chart').show();
                var date=$('#reservation').val();

                $.ajax({
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: 'ooreedoo',
                    data:{'date':date},
                    success:function (response) {
                            var label_dates = [];
                            var ooreedoo = [];
                            var amount = [];
                            for (var i = 0; i < response.length; i++) {
                                label_dates.push(response[i].date);
                                ooreedoo.push(response[i].Ooredoo);
                                amount.push(response[i].total);
                            }

                            var data = {
                                labels: label_dates,
                                datasets: [{
                                    label: "Ooreedoo",
                                    backgroundColor: "rgba(255,9,12,0.4)",
                                    borderColor: "rgba(225,99,12,1)",
                                    borderWidth: 2,
                                    hoverBackgroundColor: "rgba(255,9,12,0.4)",
                                    hoverBorderColor: "rgba(255,9,13,1)",
                                    data: ooreedoo
                                }
                                ]
                            };
                            var options = {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        },
                                        xAxes: [{
                                            // stacked: false,
                                            ticks: {
                                                max: 3,
                                                min: 0,
                                                padding: 20
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
                            if (myBarChart)
                                myBarChart.destroy();

                            myBarChart = new Chart(ctx, {
                                type: 'bar',
                                responsive: true,
                                data: data,
                                options: options
                            });
                            // });
                        }
                    // }
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
                    <form  id="ooreedoo-chart">
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

    <div class="row"  id="ooreedoo-result-chart" style="margin-left: 20px;margin-right: 20px">
        <div class="box box-primary1">
            <div class="box-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
@endsection