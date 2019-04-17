<div id="add-new"
     class="modal fade"
     tabindex="-1"
     role="dialog"
     aria-labelledby="اضافة مصروفات"
     aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">اضافة</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" action="{{ route('expenses.store') }}" class="form-add">
                @csrf
                <div class="modal-body">

                

                @include('common.forms.select',
                                array(
                                    'options'=> $employees,
                                    'value'=> 'id',
                                    'input_label'=> 'اختار الموظف',
                                    'label'=> ['f_name','l_name'],
                                    'name'=> 'employee_id'
                                )
                            )


                @include('common.forms.select',
                    array(
                        'options'=> $expenses_type,
                        'value'=> 'id',
                        'input_label'=> 'نوع المصروفات',
                        'label'=> 'name',
                        'name'=> 'expenses_type_id'
                    )
                )
                        @include('common.forms.input', ['name'=> 'received_amount', 'label'=>  'المبلغ المستلم '])
                        @include('common.forms.input', ['name'=> 'paid_amount', 'label'=> 'المبلغ المدفوع'])
                        @include('common.forms.input', ['name'=> 'payment_date', 'type'=> 'date', 'label'=> 'تاريخ الدفع'])
                        @include('common.forms.textarea', ['name'=> 'notes', 'label'=> 'ملاحظات '])
                       
                       
                        
                        
                        
                          
                        
                </div>
                <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
                </div>
            </form>
        </div>
    </div>
</div>

