@extends('layouts.app')

@section('pageTitle')
    المستخدمين
@endsection
@section('content')
    <div class="row text-center">
    <div class="col-md-6 text-left">
         @include('common.forms.search', [
            'searchLabel' => 'بحث',
            'route' => route('users.search'),
            'types' => $searchTypes
         ])
        </div>
        <div class="col-md-6">
            <button class="btn btn-success" data-toggle="modal" data-target="#add-new">مستخدم جديد</button>
        </div>
    </div>
    <br>
    <div class="row" id="main-table">
        {!! $table !!}
    </div>

    @include('backend.users.add')
    <section id="edit"></section>                


@endsection

@section('after_js')
    @include('backend.users.ajax')
@endsection
