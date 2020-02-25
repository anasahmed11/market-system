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
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        @foreach($categories as $category)
                            @if($row->cat_id==$category->id)
                                <td>{{ $category->name }}</td>
                            @endif
                        @endforeach
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



@endsection

