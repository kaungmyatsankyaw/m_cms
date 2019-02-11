@extends('layout.master')
@section('title','Status')

@section('content')

    <section class="content-header">
        <h1> Status
        </h1>
    </section>


    <script>
        $(document).ready(function () {
            // $.fn.dataTable.moment( 'HH:mm MMM D, YY' );
            // $.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );
            // $.fn.dataTable.moment('DD/MM/YYYY');

            $('.result').hide();
            $('#status').on('submit', function (e) {
                var dt = $('#status-result').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    // bSort: false,
                    scrollX: true,
                    aaSorting: [[0, 'desc']],
                    // dataSrc:'data',
                    ajax: {
                        type: "Post",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        url: 'status-data',
                        data: function (d) {
                            d.date = $('#reservation').val();
                        }
                    },
                    {{--ajax: '{{ route('status-data') }}',--}}
                    columns: [
                        {data: 'date', 'orderable': true},
                        {data: 'status.Ph Contact Finish', 'orderable': false},
                        {data: 'status.Payment Finish', 'orderable': false},
                        {data: 'status.Question Send To Astrologer', 'orderable': false},
                        {data: 'status.Answer  Reply From Astrologer', 'orderable': false},
                        {data: 'status.Audio and Text Edit Finish', 'orderable': false},
                        {data: 'status.CMS Finished', 'orderable': false},
                        {data: 'status.Confirmed', 'orderable': false},
                        {data: 'status.No Pickup', 'orderable': false},
                        {data: 'status.Can Contact', 'orderable': false},
                        {data: 'status.Busy', 'orderable': false},
                        {data: 'status.Wrong Number', 'orderable': false},
                        {data: 'status.Out of Service Area', 'orderable': false},
                        {data: 'status.Power Off', 'orderable': false},
                        {data: 'status.OverSea Number', 'orderable': false},
                        {data: 'total', 'orderable': false}
                        // {exportable:true}
                    ],
                    // columnDefs: [
                    //     { type: 'date-uk', targets: 0 }
                    // ]
                });
                e.preventDefault();
                $('.result').show();
                // $.fn.dataTable.moment('MM');
                dt.draw();

            });
            // console.log(123);
        });
    </script>

    <div class="row">
        <div class="col-md-6" style="margin-top:20px;margin-left: 20px;margin-right: 20px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Date picker</h3>
                </div>
                <div class="box-body">
                    <form method="get" id="status">
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

    <div class="row result" style="margin-left: 20px;margin-right: 20px">
        <div class="box box-primary">
            <div class="box-body">
                <table id="status-result" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        {{--@foreach($out[0]['status'] as $key=>$value)--}}
                        {{--<th>{{ $key }}</th>--}}
                        {{--@endforeach--}}
                        <th>Ph Contact Finish</th>
                        <th>Payment Finish</th>
                        <th>Question Send To Astrologer</th>
                        <th>Answer Reply From Astrologer</th>
                        <th>Audio and Text Edit Finish</th>
                        <th>CMS Finished</th>
                        <th>Confirmed</th>
                        <th>No Pickup</th>
                        <th>Can Contact</th>
                        <th>Busy</th>
                        <th>Wrong Number</th>
                        <th>Out of Service Area</th>
                        <th>Power Off</th>
                        <th>Oversea Number</th>
                        <th>Question Count</th>

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




