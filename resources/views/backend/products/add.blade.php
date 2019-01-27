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
            <form method="post" action="{{ route('products.store') }}" class="form-add">
                @csrf
                <div class="modal-body">
                    <div id="types"></div>
                    @include('common.forms.input', ['name'=> 'name', 'label'=> 'الاسم'])
                    @include('common.forms.input', ['name'=> 'price', 'label'=> 'سعر القطاعي', 'type'=> 'number'])
                    @include('common.forms.input', ['name'=> 'price2', 'label'=> 'سعر الجملة', 'type'=> 'number'])
                    @include('common.forms.input', ['name'=> 'reorder_point', 'label'=> 'نقطة الطلب', 'type'=> 'reorder_point'])
                    @include('common.forms.textarea', ['name'=> 'description', 'label'=> 'التفاصيل'])
                </div>
                <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
                </div>
            </form>
        </div>
    </div>
</div>

