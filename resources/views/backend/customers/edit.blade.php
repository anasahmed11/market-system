<div id="edit-one"
     class="modal fade"
     tabindex="-1"
     role="dialog"
     aria-labelledby="تعديل العملاء"
     aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">تعديل</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" action="{{ route('customers.update', $object->id) }}" class="form-edit">
                @csrf
                @method('PUT')
                <div class="modal-body">
                        @include('common.forms.input', ['edit'=> true, 'value'=> $object->f_name, 'name'=> 'f_name', 'label'=> 'الاسم الاول', 'type'=> 'text'])
                        @include('common.forms.input', ['edit'=> true, 'value'=> $object->l_name, 'name'=> 'l_name', 'label'=> 'الاسم الاخير', 'type'=> 'text'])
                        @include('common.forms.input', ['edit'=> true, 'value'=> $object->nickname, 'name'=> 'nickname', 'label'=> 'اسم الشهرة', 'type'=> 'text'])
                        @include('common.forms.input', ['edit'=> true, 'value'=> $object->phone, 'name'=> 'phone', 'label'=> 'رقم الموبيل', 'type'=> 'text'])
                        @include('common.forms.input', ['edit'=> true, 'value'=> $object->location, 'name'=> 'location', 'label'=> 'العنوان', 'type'=> 'text'])
                </div>
                <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
                </div>
            </form>
        </div>
    </div>
</div>

