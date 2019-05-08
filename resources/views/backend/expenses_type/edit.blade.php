<div id="edit-one"
     class="modal fade"
     tabindex="-1"
     role="dialog"
     aria-labelledby="تعديل انواع المصروفات "
     aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">تعديل</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
           
            <form method="post" action="{{ route('expensesType.update', $object->id) }}" class="form-edit">
            
                @csrf
                @method('PUT')
                <div class="modal-body">
                      
                @include('common.forms.input', ['name'=> 'name', 'label'=>  'نوع المصروفات','value'=> $object->name])
               <input type="hidden" name="id" value="{{$object->id}} " />
                
                </div>
                <div class="modal-footer">
                    @include('common.forms.close', ['label'=> 'الغاء'])
                    @include('common.forms.submit', ['label'=> 'حفظ'])
                </div>
            </form>
        </div>
    </div>
</div>

