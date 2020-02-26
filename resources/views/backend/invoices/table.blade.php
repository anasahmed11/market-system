<div id="main-table" class="row">
<div class="table-responsive">
    <table id="invoice-table"
           class="display nowrap table table-hover table-striped table-bordered"
           cellspacing="0"
           width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>التاريخ</th>
        <th>{{ $invoicesType->slug == 'buying-1'? 'اسم المورد': 'اسم العميل' }}</th>
        <th>الاجمالي</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>#</th>
        <th>التاريخ</th>
        <th>{{ $invoicesType->slug == 'buying-1'? 'اسم المورد': 'اسم العميل' }}</th>
        <th>الاجمالي</th>
        <th>التحكم</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach($data as $row)
            <tr class="customer-invoice-{{$row->id}}">
                <td>{{ $row->slug }}{{ $row->id }}</td>
                <td>{{ $row->date }}</td>
                @if ($invoicesType->slug != 'buying-1')
                    <td>
                        @if($row->customer)
                            @isset($row->customer->f_name)
                                {{ $row->customer->f_name }} {{ $row->customer->l_name }}
                            @endisset
                        @else
                        @endif
                    </td>
                @else
                    <td>
                        @if($row->supplier)
                            @isset($row->supplier->f_name)
                                {{ $row->supplier->f_name }} {{ $row->supplier->l_name }}
                            @endisset
                        @else
                        @endif
                    </td>
                @endif

                <td>{{ $row->total }}</td>
                <td>
                    <button class="invoices-details btn btn-success" data-toggle="modal" data-target="#invoices-details" data-id="{{ $row->id }}">التفاصيل</button>
                    <a href="{{ route('invoices.edit', [$invoicesType->slug, $row->id ]) }}" class="btn btn-info">تعديل</a>
                    <a  class="delete-customer-invoice btn btn-danger" data-id="{{ $row->id }}">حذف</a>
                </td>
            </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
<div class="row text-center">
    <div class="col-md-6 text-right">
        <button class="t-total btn btn-primary stat4">
            اجمالي المبيعات
            <br>
            {{$data->sum('total')}}
        </button><br>
    </div>
    <div class="col-md-6 text-left">
        <button class="t-payed btn btn-danger">
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
