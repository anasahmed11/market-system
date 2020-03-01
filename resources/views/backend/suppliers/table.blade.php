

<div class="table-responsive">
    <table class="table color-table inverse-table">
    {{ $data->appends(['sort' => 'votes'])->links() }}

    <thead>
    <tr>
        <th>#</th>
        <th>الاسم الاول</th>
        <th>الاسم الاخير</th>
        <th>اسم الشهرة</th>
        <th>رقم الموبيل</th>
        <th>العنوان</th>
        <th>اجمالي المديونية</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $supplier)
        <tr>
            <td>{{ $supplier->id }}</td>
            <td>{{ $supplier->f_name }}</td>
            <td>{{ $supplier->l_name }}</td>
            <td>{{ $supplier->nickname }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>{{ $supplier->location }}</td>
            <td>{{ $supplier->total_indebtedness }}</td>
            <td>
                @if ($supplier->total_indebtedness)
                    <button url="{{ route('suppliers_debts.types.remove', $supplier->id) }}"
                            class="btn btn-primary btn-remove-debt"
                            data-toggle="modal"
                            data-target="#remove-debts">
                        تسديد قسط
                    </button>
                @endif
                <button  url="{{ route('suppliers_debts.types.add', $supplier->id) }}"
                         class="btn btn-info btn-add-debt"
                         data-toggle="modal"
                         data-target="#add-debts">اضافة دين
                </button>
                <button class="sup-invoice btn btn-dribbble" data-toggle="modal" data-target="#invoice-details" data-id="{{ $supplier->id }}">الفواتير</button>
                <button url="{{ route('suppliers.edit', $supplier->id) }}" class="edit btn btn-warning">تعديل</button>
                <form action="{{ route('suppliers.destroy', $supplier->id) }}" class="delete-one d-inline-block" method="post" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="text-center">
    {{ $data->links() }}
</div>


<!-- Modal -->
<div class="modal fade" id="invoice-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> الفاتوره</h5>
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
                                <th>اسم الموظف</th>
                                <th>الفرع</th>
                                <th>التاريخ</th>
                                <th>اجمالي الفاتوره</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                                <th>تعديل</th>
                            </tr>

                            </thead>
                            <tbody class="supplier-invoice">
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
<!-- Modal -->
<div class="modal fade" id="edit-modal-payed" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">تعديل </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                {{Form::open(array('id'=>'edit-payed-form'))}}
                {{Form::label('المبلغ المدفوع', 'المبلغ المدفوع')}}
                {{Form::number('payed','',['class' => 'form-control','step'=>'0.0000000001','id'=>'edit-payed-payed'])}}<br><br>
                <button  class="remaining-input btn btn-danger">المتبقي</button><br><br>
                {{Form::submit('حفظ',['class' => 'btn btn-success btn-lg btn-block','id'=>'payed-edit'])}}
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>

