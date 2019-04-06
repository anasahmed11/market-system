@extends('layouts.app')

@section('pageTitle')
    فواتير
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6">
{{--            <button id="add-new-product" class="btn btn-success" data-toggle="modal" data-target="#add-new">جديد</button>--}}
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
