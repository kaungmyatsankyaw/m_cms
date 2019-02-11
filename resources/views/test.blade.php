@extends('layout.master')


@section('content')



    <div class="row ">
        <div class="col-md-6" style="margin-top:20px;margin-left: 20px;margin-right: 20px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Date picker</h3>
                </div>
                <div class="box-body">
                    <form method="post" id="count">
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


    @endsection