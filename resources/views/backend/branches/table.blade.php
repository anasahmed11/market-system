<table class="table color-table inverse-table">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>العنوان</th>
        <th>رقم الموبيل</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $branch)
    <tr>
        <td>{{ $branch->id }}</td>
        <td>{{ $branch->name }}</td>
        <td>{{ $branch->location }}</td>
        <td>{{ $branch->phone }}</td>
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
