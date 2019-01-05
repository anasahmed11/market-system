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
    @foreach($data as $suppliers)
    <tr>
        <td>{{ $suppliers->id }}</td>
        <td>{{ $suppliers->f_name }}</td>
        <td>{{ $suppliers->l_name }}</td>
        <td>{{ $suppliers->nickname }}</td>
        <td>{{ $suppliers->phone }}</td>
        <td>{{ $suppliers->location }}</td>
        <td>{{ $suppliers->total_indebtedness }}</td>
        <td>
            @if ($suppliers->total_indebtedness > 0)
                {{--<a href="{{ route('suppliers.debts', $suppliers) }}" class="btn btn-primary">تسديد قسط</a>--}}
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
