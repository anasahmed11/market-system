<table class="table color-table inverse-table">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>البريد</th>
        <th>رقم الموبيل</th>
        <th>مدير</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>
            @if ($user->is_admin)
                <span class="btn btn-success">نعم</span>
            @else
                <span class="btn btn-danger">لا</span>
            @endif
        </td>
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
