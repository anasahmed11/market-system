<div class="table-responsive">
    <table class="table color-table inverse-table">
        {{ $data->appends(['sort' => 'votes'])->links() }}

        <thead>
        <tr>
            <th>#</th>
            <th>نوع الورديه   </th>
            <th>من  </th>
            <th>الى </th>
            <th>التحكم</th>
        </thead>
        <tbody>

        @foreach($data as $row)
       
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->from }}</td>
                <td>{{ $row->to }}</td>
                
                <td>
                   
                    <button url="{{ route('shifts.edit', $row->id) }}" class="edit btn btn-warning">تعديل</button>
                    <form action="{{ route('shifts.destroy', $row->id) }}" class="delete-one d-inline-block" method="post" >
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
