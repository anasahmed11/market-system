@extends('layouts.app')

@section('pageTitle')
    نواقص المخزن
@endsection
@section('content')

<div class="row text-center">
        <div class="col-md-6 text-left">
         
        </div>
        <div class="col-md-6">
        <button class="btn btn-info" onclick="window.print();">طباعة</button>
        </div>
    </div>


    <br>
    <div id="main-table" class="row">
        {!! $table !!}
    </div>

    @include('backend.products.add')
    <section id="edit"></section>
@endsection

@section('after_js')
    @include('backend.products.ajax')
@endsection
