<table class="table color-table inverse-table">
    <thead>
    <tr>
        <th>التاريخ</th>
        <th>نوع المديونية</th>
        <th>ملاحظة</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $debt)
    <tr>
        <td>{{ $debt->created_at }}</td>
        <td>{{ $debt->type->name }}</td>
        <td>{{ $debt->note }}</td>
        <td>
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
