@extends('layout.master')
@section('title','Count')

@section('content')


    <script>
        $(document).ready(function () {

            $('.count-result-show').hide();
            $('#count').on('submit', function (e) {
                var dt = $('#count-result').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    // bSort: false,
                    // scrollX: true,
                    aaSorting: [[0, 'desc']],
                    // dataSrc:'data',
                    ajax: {
                        type: "Post",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        url: 'count-data',
                        data: function (d) {
                            d.date = $('#reservation').val();
                        }
                    },

                    columns: [
                        {data:'date'},
                        {data:'user_count'},
                        {data:'question_count'},
                        {data:'answer_count'},
                        {data:'payment_count'}
                    ]
                });
                e.preventDefault();
                $('.count_result_show').css('display','block');
                $('.count-result-show').show();
                dt.draw();

            });
        });
    </script>


    <section class="content-header">
        <h1> Count
        </h1>
    </section>

    <div class="row ">
        <div class="col-md-6" style="margin-top:20px;margin-left: 20px;margin-right: 20px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Date picker</h3>
                </div>
                <div class="box-body">
                    <form method="" id="count">
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

    <div class="row count-result-show" style="margin-left: 20px;margin-right: 20px">
        <div class="box box-primary">
            <div class="box-body">
                <table id="count-result" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User Count</th>
                        <th>Question Count</th>
                        <th>Answer Reply Count</th>
                        <th>Payment Finished Count</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection