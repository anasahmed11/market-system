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
                <a href="" class="btn btn-dribbble">الفواتير</a>
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
