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
            <form method="post" action="{{ route('expenses.update', $object->id) }}" class="form-edit">
                @csrf
                @method('PUT')
                <div class="modal-body">
                       
  

                        @include('common.forms.select',
                            array(
                                'options'=> $expenses_type,
                                'object'=> $object->expenses_type_id,
                                'value'=> 'id',
                                'input_label'=> 'نوع المصروفات',
                                'label'=> 'name',
                                'name'=> 'expenses_type_id'
                            )
                        )
                        @include('common.forms.input', ['name'=> 'received_amount','value'=> $object->received_amount, 'label'=>  'المبلغ الاجمالى '])
                        @include('common.forms.input', ['name'=> 'paid_amount', 'value'=> $object->paid_amount, 'label'=> 'المبلغ المدفوع'])
                        @include('common.forms.input', ['name'=> 'payment_date',  'value'=> $object->payment_date, 'type'=> 'date', 'label'=> 'تاريخ الدفع'])
                        @include('common.forms.textarea', ['name'=> 'notes', 'value'=> $object->notes,  'label'=> 'ملاحظات '])
                       

                </div>
                <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
                </div>
            </form>
        </div>
    </div>
</div>

