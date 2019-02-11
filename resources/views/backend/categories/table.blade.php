<div class="table-responsive">
    <table class="table color-table inverse-table">
    {{ $data->appends(['sort' => 'votes'])->links() }}

    <thead>
    <tr>
        <th>#</th>
        <th>النوع</th>
        <th>الصنف</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>
                    @if($row->parent)
                        @isset($row->rowParent->name)
                            {{ $row->rowParent->name }}
                        @endisset
                    @else
                    @endif
                </td>
                <td>{{ $row->name }}</td>
                <td>
                    <button url="{{ route('categories.edit', $row->id) }}" parent="@if($row->parent){{ 0 }}@else{{ 1 }}@endif" type-url="{{ route('categories.types.edit', $row->id) }}" class="edit btn btn-warning">تعديل</button>
                    {{--<form action="{{ route('categories.destroy', $row->id) }}" class="delete-one d-inline-block" method="post" >--}}
                        {{--@csrf--}}
                        {{--@method('DELETE')--}}
                        {{--<button type="submit" class="btn btn-danger">حذف</button>--}}
                    {{--</form>--}}
                </td>
            </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="text-center">
    {{ $data->links() }}
</div>
