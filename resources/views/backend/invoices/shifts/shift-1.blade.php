@extends('layouts.app')

@section('pageTitle')
فواتير الورديه
@endsection
@section('content')
<div class="row text-center">
    <div class="col-md-6 text-left">

    </div>
    <div class="col-md-6">
        @foreach($shifts as $shift)
            <button class="shift-select btn btn-warning" data-id="{{$shift->id}}">
                {{$shift->name}}
            </button>
        @endforeach
        <button class="btn btn-info" onclick="window.print();" >طباعة</button>
        <br>
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
                <th>اسم العميل</th>
                <th>الفرع</th>
                <th>التاريخ</th>
                <th>المجموع الفرعي</th>
                <th>اجمالي الفاتوره</th>
                <th>القيمه المضافه</th>
                <th>الخصم</th>
                <th>المدفوع</th>
                <th>المتبقي</th>
                <th>التفاصيل</th>

            </tr>
            </thead>
            <tbody class="shift-table">
            @foreach($data as $row)
            <tr class="shift-{{$row->id}}">
                <td>{{ $row->slug }}</td>
                <td>{{ $row->employer->employer->f_name}} {{$row->employer->employer->l_name }}</td>
                <td>{{ $row->customer->nickname }}</td>
                <td>{{ $row->branch->name }}</td>
                <td>{{ $row->date }}</td>
                <td>{{ $row->sub_total }}</td>
                <td>{{ $row->total }}</td>
                <td>{{ $row->added_value }}</td>
                <td>{{ $row->discount_value }}</td>
                <td>{{ $row->payed }}</td>
                <td>{{ $row->remaining }}</td>
                <td><button class="invoices-details btn btn-success" data-toggle="modal" data-target="#invoices-details" data-id="{{ $row->id }}">التفاصيل</button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row text-center">
    <div class="col-md-6 text-right">
        <button class="total btn btn-primary stat4">
            اجمالي المبيعات
            <br>
            {{$data->sum('total')}}
        </button><br>
    </div>
    <div class="col-md-6 text-left">
        <button class="payed btn btn-danger">
            اجمالي المدفوع
            <br>
            {{$data->sum('payed')}}
        </button><br>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="invoices-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <tbody class="helloo">
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




