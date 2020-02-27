@extends('layouts.app')

@section('pageTitle')
     قائمه المنتجات الاكثر مبيعا
@endsection
@section('content')

    <div class="row text-center">
        <div class="col-md-6 text-left">

        </div>
        <div class="col-md-6">
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
                    <th>الصنف</th>
                    <th>الاسم</th>
                    <th>كميه المبيعات</th>
                    <th>سعرالبيع (قطاعي)</th>
                    <th>سعرالبيع (جمله)</th>

                </tr>
                </thead>
                <tbody class="stock">
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->product->name }}</td>
                        <td>{{ $row->category->name }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->product->price }}</td>
                        <td>{{ $row->product->price2 }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection




