@extends('layouts.app')

@section('pageTitle')
    الاصناف
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6 text-left">
         @include('common.forms.search', [
            'searchLabel' => 'بحث',
            'route' => route('categories.search'),
            'types' => $searchTypes
         ])
        </div>
        <div class="col-md-6">
            <button class="add-new btn btn-success" data-toggle="modal" data-target="#add-new" parent="0">صنف جديد</button>
            <button class="add-new btn btn-primary" data-toggle="modal" data-target="#add-new" parent="1">نوع جديد</button>
        </div>
    </div>
    <br>
    <div id="main-table" class="row">
        {!! $table !!}
    </div>

    @include('backend.categories.add')
    <section id="edit"></section>
@endsection

@section('after_js')
    @include('backend.categories.ajax')
@endsection
