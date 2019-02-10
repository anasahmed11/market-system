<div id="add-new"
     class="modal fade"
     tabindex="-1"
     role="dialog"
     aria-labelledby="اضافة مستخدم"
     aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">اضافة</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" action="{{ route('customers.store') }}" class="form-add">
                @csrf
                <div class="modal-body">
                        @include('common.forms.input', ['name'=> 'f_name', 'label'=> 'الاسم الاول'])
                        @include('common.forms.input', ['name'=> 'l_name', 'label'=> 'الاسم الاخير'])
                        @include('common.forms.input', ['name'=> 'nickname', 'label'=> 'اسم الشهرة'])
                        @include('common.forms.input', ['name'=> 'phone', 'label'=> 'رقم الموبيل'])
                        @include('common.forms.input', ['name'=> 'location', 'label'=> 'العنوان'])
                </div>
                <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
                </div>
            </form>
        </div>
    </div>
</div>

