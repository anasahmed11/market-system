<div class="table-responsive">
    <table class="table color-table inverse-table">
        {{ $data->appends(['sort' => 'votes'])->links() }}

        <thead>
        <tr>
            <th>#</th>
            <th>نوع المصروفات  </th>
  
            <th>التحكم</th>
        </thead>
        <tbody>

        @foreach($data as $row)
       
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>
                   
                    <button url="{{ route('expensesType.edit', $row->id) }}" class="edit btn btn-warning">تعديل</button>
                    <form action="{{ route('expensesType.destroy', $row->id) }}" class="delete-one d-inline-block" method="post" >
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
