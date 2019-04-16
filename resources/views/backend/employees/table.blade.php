<div class="table-responsive">
    <table class="table color-table inverse-table">
        {{ $data->appends(['sort' => 'votes'])->links() }}

        <thead>
        <tr>
            <th>#</th>
            <th>الاسم الاول</th>
            <th>الاسم الاخير</th>
            <th>رقم الموبيل</th>
            <th>العنوان</th>
            <th>التحكم</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->f_name }}</td>
                <td>{{ $employee->l_name }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->location }}</td>
                <td>
                   
                    <button url="{{ route('employees.edit', $employee->id) }}" class="edit btn btn-warning">تعديل</button>
                    <form action="{{ route('employees.destroy', $employee->id) }}" class="delete-one d-inline-block" method="post" >
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
