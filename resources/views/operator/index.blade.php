@extends('layout.master')

@section('title','Operator')

@section('content')

    <section class="content-header">
        <h1> Operator
        </h1>
    </section>

    <script>
        $(document).ready(function () {
            $('#operator-result').hide();
            $('#operator').on('submit', function (e) {
                // alert(123);
                var dt = $('#operator-data').DataTable({
                    processing: true,
                    serverSide: true,
                    // bSort: false,
                    destroy:true,
                    aaSorting:[[0,'desc']],
                    // dataSrc: 'data',
                    ajax: {
                        type:"Post",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        url: 'operator-data',
                        data: function (d) {
                            d.date = $('#reservation').val();
                        }
                    },
                    {{--ajax: '{{ route('status-data') }}',--}}
                    columns: [
                        {data:'date','orderable':true},
                        {data:'operator.MEC','orderable':false},
                        {data:'operator.MPT','orderable':false},
                        {data:'operator.Ooredoo','orderable':false},
                        {data:'operator.Telenor','orderable':false},
                        {data:'total','orderable':true}
                    ]
                });

                e.preventDefault();
                $('#operator-result').show();
                dt.draw();
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
                    <form method="" id="operator">
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

    <div class="row"  id="operator-result" style="margin-left: 20px;margin-right: 20px">
        <div class="box box-primary">
            <div class="box-body">
                <table id="operator-data" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>MEC</th>
                        <th>MPT</th>
                        <th>Ooredoo</th>
                        <th>Telenor</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection



{{--<!-- @yield('result_section') -->--}}


