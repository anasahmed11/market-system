@extends('layouts.app')

@section('pageTitle')
    حالة  المخزن
@endsection
@section('content')

<div class="row text-center">
        <div class="col-md-6 text-left">
         
        </div>
        <div class="col-md-6">
        <button class=" filter btn btn-info"    data-flag="all" type="button">الكل  </button>
        <button class=" filter btn btn-danger"  data-flag="out"   type="button">نفذ من النخزن </button>
        <button class=" filter btn btn-success" data-flag="notOut"  type="button">متوفر فى المخزن </button>
       
        <button class="btn btn-info" onclick="window.print();" >طباعة</button>
        </div>
    </div>


    <br>
    <div id="main-table" class="row">
        {!! $table !!}
    </div>

   
   
@endsection

@section('after_js')
    @include('backend.reports.ajax')
@endsection

