@extends('layouts.app')

@section('pageTitle')
    المستخدمين
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-12">
            <button class="btn btn-success" data-toggle="modal" data-target="#add-new">مستخدم جديد</button>
        </div>
    </div>
    <br>
    <div class="row">
        {!! $table !!}
    </div>

    @include('backend.users.add')
    <section id="edit"></section>                


@endsection

@section('after_js')
    @include('backend.users.ajax')
@endsection
