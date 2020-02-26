@extends('layouts.app')

@section('pageTitle')
    كل الفواتير
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
        <div class="table-responsive">
            <table class="table color-table inverse-table">

                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الموظف</th>
                    <th>اسم المورد</th>
                    <th>الفرع</th>
                    <th>التاريخ</th>
                    <th>اجمالي الفاتوره</th>
                    <th>الخصم</th>
                    <th>المدفوع</th>
                    <th>المتبقي</th>
                    <th>التفاصيل</th>
                    <th>تعديل</th>
                    <th>حذف</th>

                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr class="invoice-{{$row->id}}">
                        <td>{{ $row->slug }}</td>
                        <td>{{ $row->employer->employer->f_name}} {{$row->employer->employer->l_name }}</td>
                        <td>{{ $row->supplier->nickname }}</td>
                        <td>{{ $row->branch->name }}</td>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->total }}</td>
                        <td>{{ $row->discount_value }}</td>
                        <td>{{ $row->payed }}</td>
                        <td>{{ $row->remaining }}</td>
                        <td>
                            <button class="s-invoice-details btn btn-success" data-toggle="modal" data-target="#invoice-details" data-id="{{ $row->id }}">التفاصيل</button>
                        </td>
                        <td>
                            <a href="{{ route('invoices.edit', ['buying-1', $row->id ]) }}"><button  class="btn btn-info">تعديل</button></a>
                        </td>
                        <td>
                            <button class="delete-supplier-invoice  btn btn-danger"  data-id="{{ $row->id }}">حذف</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-6 text-right">
            <button class="btn btn-primary stat4">
                اجمالي المشتريات
                <br>
                {{$data->sum('total')}}
            </button><br>
        </div>
        <div class="col-md-6 text-left">
            <button class="btn btn-warning stat4">
                اجمالي المدفوع
                <br>
                {{$data->sum('payed')}}
            </button><br>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="invoice-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">تفاصيل الفاتوره</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="main-table" class="row">
                        <div class="">
                            <table class="table color-table inverse-table">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المنتج</th>
                                    <th>اسم الصنف</th>
                                    <th>السعر</th>
                                    <th>الكميه</th>
                                    <th>المجموع الفرعي</th>
                                </tr>

                                </thead>
                                <tbody class="hello">
                                <tr class="inv-details-product">

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>

@endsection


