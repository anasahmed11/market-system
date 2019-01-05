<table class="table color-table inverse-table">
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
            <a href="" class="btn btn-warning">تعديل</a>
            <a href="" class="btn btn-danger">حذف</a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<div class="text-center">
    {{ $data->links() }}
</div>
