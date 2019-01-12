<div id="add-debts"
     class="modal fade"
     tabindex="-1"
     role="dialog"
     aria-labelledby="اضافة دين"
     aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">اضافة</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="form-add-debts" method="post">
                @csrf
                <div class="modal-body">
                    <div id="debt-types"></div>
                    @include('common.forms.textarea', ['label'=> 'الوصف', 'name'=> 'description'])
                    @include('common.forms.input', ['label'=> 'التاريخ', 'name'=> 'date', 'type'=> 'date'])
                </div>
                <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
                </div>
            </form>
        </div>
    </div>
</div>

