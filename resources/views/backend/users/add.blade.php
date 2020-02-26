
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
                <h4 class="modal-title">اضافة مستخدم</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" action="{{ route('users.store') }}" class="form-add">
            <div class="modal-body">

                @csrf

                    @include('common.forms.select',
                                array(
                                    'options'=> $employees,
                                    'value'=> 'id',
                                    'input_label'=> 'اختار الموظف',
                                    'label'=> ['f_name','l_name'],
                                    'name'=> 'employee_id'
                                )
                            )
                        <div class="form-group">
                            <label for="is_admin" class="control-label">صلاحيه الدخول</label>
                            <select name="is_admin" id="is_admin" class="select2 form-control" style="max-width: 100%!important;">
                                <option value="1">مدير</option>
                                <option value="2">مدير مخزن</option>
                                <option value="3">مدير اداره</option>


                            </select>
                        </div>
                        @include('common.forms.input', ['name'=> 'email','type'=> 'email','label'=>  'االبريد'])
                        @include('common.forms.input', ['name'=> 'phone','type'=> 'phone','label'=>  'الموبيل'])
                        @include('common.forms.input', ['name'=> 'password','type'=> 'password', 'label'=> 'كلمة المرور'])
                        @include('common.forms.input', ['name'=> 'cpassword','type'=> 'password', 'label'=> 'تاكيد كلمة المرور'])



            </div>
            <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
            </div>
            </form>
        </div>
    </div>
</div>
