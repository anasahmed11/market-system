<div class="table-responsive">
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
        <td><button class="user-details btn btn-success" data-toggle="modal" data-target="#user-details" data-id="{{ $user->employee_id }}">معلومات المستخدم</button></td>
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
        <button url="{{ route('users.edit', $user->id) }}" class="edit btn btn-warning">تعديل</button>
        <form action="{{ route('users.destroy', $user->id) }}" class="delete-one d-inline-block" method="post" >
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
<!-- Modal -->
<div class="modal fade" id="user-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">معلومات المستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="main-table" class="row">
                    <div class="">
                        <table class="table color-table inverse-table">

                            <thead>
                            <tr>
                                <th>الاسم الاول</th>
                                <th>الاسم الثاني</th>
                                <th>العنوان</th>
                                <th>رقم التليفون</th>
                                <th>تاريخ التعيين</th>
                            </tr>

                            </thead>
                            <tbody class="user">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
