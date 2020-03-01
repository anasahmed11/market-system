@extends('layouts.app')

@section('pageTitle')
    المصروفات
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6 text-left">
         @include('common.forms.search', [
            'searchLabel' => 'بحث',
            'route' => route('expenses.search'),
            'types' => $searchTypes
         ])
        </div>
        <div class="col-md-6">
            <button class="btn btn-success" data-toggle="modal" data-target="#add-new">جديد</button>
            <button class="total-expenses btn btn-primary" data-toggle="modal" data-target="#total-expenses">اجمالي المصروفات</button>
        </div>
    </div>
    <br>
    <div id="main-table" class="row">
        {!! $table !!}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="total-expenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">تقرير</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="total-exp btn btn-primary">اجمالي الممصاريف المدفوعه<br>
                            </button>
                            <button class="total-exp-re btn btn-primary">اجمالي الممصاريف المتبقيه<br>
                            </button>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    @include('backend.expenses.add')
    <section id="edit"></section>
@endsection

@section('after_js')
    @include('backend.expenses.ajax')
@endsection
