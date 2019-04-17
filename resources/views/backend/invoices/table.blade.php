<div class="table-responsive">
    <table id="invoice-table"
           class="display nowrap table table-hover table-striped table-bordered"
           cellspacing="0"
           width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>التاريخ</th>
        <th>{{ $invoicesType->slug == 'buying-1'? 'اسم المورد': 'اسم العميل' }}</th>
        <th>الاجمالي</th>
        <th>التحكم</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>#</th>
        <th>التاريخ</th>
        <th>{{ $invoicesType->slug == 'buying-1'? 'اسم المورد': 'اسم العميل' }}</th>
        <th>الاجمالي</th>
        <th>التحكم</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach($data as $row)
            <tr>
                <td>{{ $row->slug }}{{ $row->id }}</td>
                <td>{{ $row->date }}</td>
                @if ($invoicesType->slug != 'buying-1')
                    <td>
                        @if($row->customer)
                            @isset($row->customer->f_name)
                                {{ $row->customer->f_name }} {{ $row->customer->l_name }}
                            @endisset
                        @else
                        @endif
                    </td>
                @else
                    <td>
                        @if($row->supplier)
                            @isset($row->supplier->f_name)
                                {{ $row->supplier->f_name }} {{ $row->supplier->l_name }}
                            @endisset
                        @else
                        @endif
                    </td>
                @endif

                <td>{{ $row->total }}</td>
                <td>
                    <a href="{{ route('invoices.edit', $row->id) }}" class="btn btn-info">تعديل</a>
                    <a href="{{ route('invoices.delete', $row->id) }}" class="btn btn-danger">حذف</a>
{{--                    <button url="{{ route('invoices.index') }}" class="edit btn btn-warning">تعديل</button>--}}
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
