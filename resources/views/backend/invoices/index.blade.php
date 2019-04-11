@extends('layouts.app')

@section('pageTitle')
    فواتير
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6">
{{--            <button id="add-new-product" class="btn btn-success" data-toggle="modal" data-target="#add-new">جديد</button>--}}
           من <input type="date" name="from" class="form-group datepicker">
            الي<input type="date" name="to" class="form-group datepicker">

            <div class='input-group date datepicker ' id='datetimepicker1'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
        </div>
    </div>
    <br>
    <div id="main-table" class="row">
        {!! $table !!}
    </div>
@endsection

@section('after_js')
    <script>

        $('#main-table').DataTable();
    </script>
@endsection
