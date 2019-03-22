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
            <form method="post" action="{{ route('categories.update', $object->id) }}" class="form-edit">
                @csrf
                @method('PUT')
                <div class="modal-body">
                   <div id="types-edit"></div>
                    @include('common.forms.input', ['edit'=> true, 'value'=> $object->name, 'name'=> 'name', 'label'=> 'الاسم'])
                    @include('common.forms.textarea', ['edit'=> true, 'value'=> $object->description,'name'=> 'description', 'label'=> 'التفاصيل'])      </div>
                <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
                </div>
            </form>
        </div>
    </div>
</div>

