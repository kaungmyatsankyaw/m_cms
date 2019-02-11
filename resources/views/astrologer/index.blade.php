@extends('layout.master')

@section('title','Home')


@section('content')

    <section class="content-header">
        <h1> Astrologer
        </h1>
    </section>

    <script>
        $(document).ready(function () {
            $('#astrologer-result').hide();
            $('#astrologer').on('submit', function (e) {
                // alert(123);
                var dt = $('#astrologer-data').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy:true,
                    aaSorting:[[0,'desc']],
                    ajax: {
                        type: "Post",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        url: 'astrologer',
                        data: function (d) {
                            d.date = $('#reservation').val();
                        }
                    },
                    columns: [
                        {data: 'date',"orderable":true},
                        {data: 'astrologer.ဆရာမ ေဒၚသီရိထက္စိုး',"orderable":false},
                        {data: 'astrologer.ဆရာမေဒၚဆုလဲ့ရတနာ',"orderable":false},
                        {data: 'astrologer.ဆရာမေဒၚယမင္းေအာင္',"orderable":false},
                        {data: 'astrologer.ဆရာဦး၀င္းေဇာ္ ( သစ္ေတာ )',"orderable":false},
                        {data: 'astrologer.ဆရာဦးေက်ာ္ေဇာသိမ္း',"orderable":false},
                        {data: 'total',"orderable":false}
                    ]
                });

                e.preventDefault();
                // dt.destroy();
                $('#astrologer-result').show();
                // dt.destroy();

                dt.draw();
            });
        });
    </script>

    <div class="row">
        <div class="col-md-6" style="margin-top:20px;margin-left: 20px;margin-right: 20px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Date picker</h3>
                </div>
                <div class="box-body">
                    <form id="astrologer">
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
                            <!-- /.input group -->
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>


    <div class="row" id="astrologer-result" style="margin-left: 20px;margin-right: 20px">
        <div class="box box-primary">
            <div class="box-body">
                <table id="astrologer-data" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>ဆရာမ ေဒၚသီရိထက္စိုး</th>
                        <th>ဆရာမေဒၚဆုလဲ့ရတနာ</th>
                        <th>ဆရာမေဒၚယမင္းေအာင္</th>
                        <th>ဆရာဦး၀င္းေဇာ္ ( သစ္ေတာ )</th>
                        <th>ဆရာဦးေက်ာ္ေဇာသိမ္း</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@for($i=0;$i<count($out);$i++)--}}
                    {{--<tr>--}}
                    {{--<td>{{ $out[$i]['date'] }}</td>--}}
                    {{--@foreach($out[$i]['status'] as $key=>$value)--}}
                    {{--<td>{!! $value !!}</td>--}}
                    {{--@endforeach--}}
                    {{--<td>{{ $out[$i]['total'] }}</td>--}}
                    {{--</tr>--}}
                    {{--@endfor--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection





