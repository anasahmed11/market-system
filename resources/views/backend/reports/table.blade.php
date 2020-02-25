<div class="table-responsive">
    <table class="table color-table inverse-table">
    {{ $data->appends(['sort' => 'votes'])->links() }}

    <thead>
    <tr>
        <th>#</th>
        <th>الصنف</th>
        <th>الاسم</th>
        <th>سعر البيع (القطاعي)</th>
        <th>سعر البيع (الجملة)</th>
        <th>نقطة الطلب</th>
        <th>الكمية</th>
        <th>التفاصيل</th>

    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
    <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->category->rowParent->name }} , {{ $row->category->name }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->price }}</td>
        <td>{{ $row->price2 }}</td>
        <td>{{ $row->reorder_point }}</td>
        <td>{{ $row->quantity }}</td>
        <td>
            {{ str_limit($row->description, $limit = 20, $end = '...') }}
        </td>

    </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="text-center">
    {{ $data->links() }}
</div>
