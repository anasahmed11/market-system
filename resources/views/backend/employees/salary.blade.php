@extends('layouts.app')

@section('pageTitle')
    المرتبات
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6 text-left">

        </div>
        <div class="col-md-6">
            <button class="new-salary btn btn-success" data-toggle="modal" data-target="#new-salary-model">دفع مرتب</button>
            <button class="btn btn-info" onclick="window.print();" >طباعة</button>
            <button class="total-salary btn btn-warning" data-toggle="modal" data-target="#total-salary-model">اجمالي المرتبات</button>
            <br>
        </div>
    </div>


    <br>
    <div id="main-table" class="row">
        <div class="table-responsive">
            <table class="table color-table inverse-table">

                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المستخدم</th>
                    <th>اسم الموظف</th>
                    <th>تاريخ الدفع</th>
                    <th>المدفوع</th>
                    <th>المتبقي</th>
                    <th>ملاحظات</th>

                </tr>
                </thead>
                <tbody class="salary-table">
                @foreach($data as $row)
                    <tr class="salary-{{$row->id}}">
                        <td>{{$row->id}}</td>
                        <td>{{ $row->user->employer->f_name}} {{$row->user->employer->l_name }}</td>
                        <td>{{ $row->employer->f_name}} {{$row->employer->l_name }}</td>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->payed }}</td>
                        <td>{{ $row->remaining }}</td>
                        <td>{{$row->notes}}</td>
                        <td><button class="edit-salary btn btn-success"  data-toggle="modal" data-target="#edit-modal-salary" data-id="{{ $row->id }}" data-user-id="{{ $row->user_id }}" data-employee-id="{{ $row->employee_id }}" data-payed="{{ $row->payed }}" data-remaining ="{{$row->remaining}}" data-notes="{{$row->notes}}" data-date="{{$row->date}}">تعديل</button></td>
                        <td><button class="delete-salary btn btn-danger" data-id="{{ $row->id }}">حذف</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="new-salary-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضافه جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('id'=>'new-salary-form'))}}
                    {{ Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control','id'=>'salary-user-id']) }}
                    {{Form::label('اختر الموظف', 'اختر الموظف')}}
                    <select name="employee_id"  class="select-employee select2 form-control" style="width: 100%; height:36px;">
                        <option>اختار الموظف</option>
                        @foreach($employees as $employee)
                            <option value="{{$employee->id}}" salary="{{$employee->salary}}">{{$employee->f_name }} {{$employee->l_name}}</option>
                        @endforeach
                    </select><br><br>
                    <button  class="salary-input btn btn-danger">المرتب</button><br><br>
                    {{Form::label('تاريخ الدفع', 'تاريخ الدفع')}}
                    {{ Form::date('date', '', ['class' => 'form-control','id'=>'salary-date'])}}<br>
                    {{Form::label('المبلغ المدفوع', 'المبلغ المدفوع')}}
                    {{Form::number('payed','',['class' => 'form-control','step'=>'0.0000000001'])}}<br>
                    {{Form::label('المبلغ المتبقي', 'المبلغ المتبقي')}}
                    {{Form::number('remaining','',['class' => 'form-control','step'=>'0.0000000001'])}}<br><br>
                    {{Form::textarea('notes','',['class' => 'form-control','rows' =>3,'cols'=>10,'placeholder'=>'الملاحظات'])}}<br><br>
                    {{Form::submit('حفظ',['class' => 'btn btn-success btn-lg btn-block','id'=>'new-salary'])}}
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- total-Modal -->
    <div class="modal fade" id="total-salary-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضافه جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-12 ">
                            <button class="payed btn btn-primary btn-block ">
                                اجمالي المرتبات المدفوعه
                                <br>
                                {{$data->sum('payed')}}
                            </button><br>
                            <button class="remaining btn btn-danger btn-block">
                                اجمالي المرتبات المتبقيه
                                <br>
                                {{$data->sum('remaining')}}
                            </button><br>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit-modal-salary" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">تعديل </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('id'=>'edit-salary-form'))}}
                    {{ Form::hidden('user_id', '', ['class' => 'form-control','id'=>'edit-salary-user-id']) }}
                    {{Form::label('اختر الموظف', 'اختر الموظف')}}
                    <select name="employee_id" class="select-employee select2 form-control" style="width: 100%; height:36px;">
                        <option>اختار الموظف</option>
                        @foreach($employees as $employee)
                            <option  value="{{$employee->id}}" salary="{{$employee->salary}}">{{$employee->f_name }} {{$employee->l_name}}</option>
                        @endforeach
                    </select><br><br>
                    <button  class="salary-input btn btn-danger">المرتب</button><br><br>
                    {{Form::label('تاريخ الدفع', 'تاريخ الدفع')}}
                    {{ Form::date('date', '', ['class' => 'form-control','id'=>'edit-salary-date'])}}<br>
                    {{Form::label('المبلغ المدفوع', 'المبلغ المدفوع')}}
                    {{Form::number('payed','',['class' => 'form-control','step'=>'0.0000000001','id'=>'edit-payed'])}}<br>
                    {{Form::label('المبلغ المتبقي', 'المبلغ المتبقي')}}
                    {{Form::number('remaining','',['class' => 'form-control','step'=>'0.0000000001','id'=>'edit-remaining'])}}<br><br>
                    {{Form::textarea('notes','',['class' => 'form-control','rows' =>3,'cols'=>10,'placeholder'=>'الملاحظات','id'=>'edit-notes'])}}<br><br>
                    {{Form::submit('حفظ',['class' => 'btn btn-success btn-lg btn-block','id'=>'edit-salary'])}}
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
@endsection





