@extends('layouts.app')

@section('pageTitle')
    فاتورة
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6 text-left">
            @include('common.forms.search', [
               'searchLabel' => 'بحث',
               'route' => route('products.search'),
               'types' => $searchTypes
            ])
        </div>
        <div class="col-md-6">
            <button id="add-new-product" class="btn btn-success" data-toggle="modal" data-target="#add-new">جديد</button>
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
