<div class="table-responsive">
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
            <button url="{{ route('branches.edit', $branch->id) }}" class="edit btn btn-warning">تعديل</button>
            <form action="{{ route('branches.destroy', $branch->id) }}" class="delete-one d-inline-block" method="post" >
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
