@extends('layouts.app')

@section('pageTitle')
      المخزن
@endsection
@section('content')

    <div class="row text-center">
        <div class="col-md-6 text-left">

        </div>
        <div class="col-md-6">
            <button class="empty-stock filter btn btn-danger"   data-flag="out"   type="button">نفذ من النخزن </button>
            <button class="full-stock filter btn btn-success"  data-flag="notOut"  type="button">متوفر فى المخزن </button>
            <button class="filter btn btn-warning" data-toggle="modal" data-target="#stock-details"  data-flag="notOut"  type="button">اجمالي البضاعه المتوفره  </button>
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
                    <th>الصنف</th>
                    <th>الاسم</th>
                    <th>سعر البيع (القطاعي)</th>
                    <th>سعر البيع (الجملة)</th>
                    <th>نقطة الطلب</th>
                    <th>الكمية</th>
                    <th>التفاصيل</th>

                </tr>
                </thead>
                <tbody class="stock">
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->category->name }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->price }}</td>
                        <td>{{ $row->price2 }}</td>
                        <td>{{ $row->reorder_point }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>
                            {{ str_limit($row->description, $limit = 20, $end = '...') }}
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="stock-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> تقارير المخزن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-4 text-right">
                            <br>
                            <button class="btn  btn-block btn-primary">
                                اجمالي السعر قطاعي
                                <br>
                                {{$data->sum('price')}}
                            </button>
                        </div>
                        <div class="col-md-4 text-center" >
                            <br>
                            <button class="btn btn-block btn-warning">
                                اجمالي المنتجات
                                <br>
                                {{$data->sum('quantity')}}
                            </button>
                        </div>
                        <div class="col-md-4 text-left">
                            <br>
                            <button class="btn  btn-block btn-primary">
                                اجمالي السعر جمله
                                <br>
                                {{$data->sum('price2')}}
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


@endsection



