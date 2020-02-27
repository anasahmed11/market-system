<div id="main-table" class="row">
<div class="table-responsive">
    <table class="table color-table inverse-table">
        {{ $data->appends(['sort' => 'votes'])->links() }}

        <thead>
        <tr>
            <th>#</th>
            <th>المستخدم   </th>
            <th>المبلغ الاجمالى </th>
            <th>المبلغ المدفوع </th>
            <th>تاريخ الدفع  </th>
            <th> ملاحظات  </th>
            <th> نوع المصاريف  </th>
            <th>التحكم</th>
        </thead>
        <tbody>

        @foreach($data as $row)

            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->user->employer->f_name }} {{ $row->user->employer->l_name }}</td>
                <td>{{ $row->received_amount }}</td>
                <td>{{ $row->paid_amount }}</td>
                <td>{{ $row->payment_date }}</td>
                <td>{{ $row->notes }}</td>
                <td>{{ $row->expenseType->name }}</td>
                <td>

                    <button url="{{ route('expenses.edit', $row->id) }}" class="edit btn btn-warning">تعديل</button>
                    <form action="{{ route('expenses.destroy', $row->id) }}" class="delete-one d-inline-block" method="post" >
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
</div>
<div class="row text-center">
    <div class="col-md-6 text-right">
        <button class="t-total btn btn-primary stat4">
            اجمالي المبلغ المدفوع
            <br>
            {{$data->sum('paid_amount')}}
        </button><br>
    </div>
    <div class="col-md-6 text-left">
        <button class="t-payed btn btn-danger">
            اجمالي المبلغ المستحق
            <br>
            {{$data->sum('received_amount')}}
        </button><br>
    </div>
</div>

<div class="text-center">
    {{ $data->links() }}
</div>
