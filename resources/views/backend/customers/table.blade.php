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
    @foreach($data as $customer)
    <tr>
        <td>{{ $customer->id }}</td>
        <td>{{ $customer->f_name }}</td>
        <td>{{ $customer->l_name }}</td>
        <td>{{ $customer->nickname }}</td>
        <td>{{ $customer->phone }}</td>
        <td>{{ $customer->location }}</td>
        <td>{{ $customer->total_indebtedness }}</td>
        <td>
            @if ($customer->total_indebtedness > 0)
                <a href="{{ route('customers.debts', $customer) }}" class="btn btn-primary">تسديد قسط</a>
            @endif
            <button  url="{{ route('debts.types.add', $customer->id) }}" class="btn btn-info btn-add-debt" data-toggle="modal" data-target="#add-debts">اضافة دين</button>
            <a href="" class="btn btn-dribbble">الفواتير</a>
            <button url="{{ route('customers.edit', $customer->id) }}" class="edit btn btn-warning">تعديل</button>
            <form action="{{ route('customers.destroy', $customer->id) }}" class="delete-one d-inline-block" method="post" >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">حذف</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<div class="text-center">
    {{ $data->links() }}
</div>
