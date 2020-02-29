@extends('layouts.app')

@section('pageTitle')
    السلف
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6 text-left">

        </div>
        <div class="col-md-6">
            <button class="new-salary btn btn-success" data-toggle="modal" data-target="#new-loan-model">دفع سلفه</button>
            <button class="btn btn-info" onclick="window.print();" >طباعة</button>
            <button class="total-loan btn btn-warning" data-toggle="modal" data-target="#total-loan-model">اجمالي السلف</button>
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
                    <th>ملاحظات</th>
                    <th>تعديل</th>
                    <th>حذف</th>

                </tr>
                </thead>
                <tbody class="loan-table">
                @foreach($data as $row)
                    <tr class="loan-{{$row->id}}">
                        <td>{{$row->id}}</td>
                        <td>{{ $row->user->employer->f_name}} {{$row->user->employer->l_name }}</td>
                        <td>{{ $row->employer->f_name}} {{$row->employer->l_name }}</td>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->payed }}</td>
                        <td>{{$row->notes}}</td>
                        <td><button class="edit-loan btn btn-success"  data-toggle="modal" data-target="#edit-modal-loan" data-id="{{ $row->id }}" data-user-id="{{ $row->user_id }}" data-employee-id="{{ $row->employee_id }}" data-payed="{{ $row->payed }}"  data-notes="{{$row->notes}}" data-date="{{$row->date}}">تعديل</button></td>
                        <td><button class="delete-loan btn btn-danger" data-id="{{ $row->id }}" data-emp-id="{{$row->employee_id}}">حذف</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="new-loan-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضافه جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('id'=>'new-loan-form'))}}
                    {{ Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control','id'=>'loan-user-id']) }}
                    {{Form::label('اختر الموظف', 'اختر الموظف')}}
                    <select name="employee_id"  class="select2-employee select2 form-control" style="width: 100%; height:36px;">
                        <option>اختار الموظف</option>
                        @foreach($employees as $employee)
                            <option value="{{$employee->id}}" loan="{{$employee->loans}}">{{$employee->f_name }} {{$employee->l_name}}</option>
                        @endforeach
                    </select><br><br>
                    <button  class="loan-input btn btn-danger">السلف</button><br><br>
                    {{Form::label('تاريخ الدفع', 'تاريخ الدفع')}}
                    {{ Form::date('date', '', ['class' => 'form-control','id'=>'loan-date'])}}<br>
                    {{Form::label('المبلغ المدفوع', 'المبلغ المدفوع')}}
                    {{Form::number('payed','',['class' => 'form-control','step'=>'0.0000000001'])}}<br><br>
                    {{Form::textarea('notes','',['class' => 'form-control','rows' =>3,'cols'=>10,'placeholder'=>'الملاحظات'])}}<br><br>
                    {{Form::submit('حفظ',['class' => 'btn btn-success btn-lg btn-block','id'=>'new-loan'])}}
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- total-Modal -->
    <div class="modal fade" id="total-loan-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">تقرير</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-12 ">
                            <button class="payed btn btn-primary btn-block ">
                                اجمالي السلف المدفوعه
                                <br>
                                {{$data->sum('payed')}}
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
    <div class="modal fade" id="edit-modal-loan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">تعديل </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('id'=>'edit-loan-form'))}}
                    {{ Form::hidden('user_id', '', ['class' => 'form-control','id'=>'edit-loan-user-id']) }}
                    {{Form::label('اختر الموظف', 'اختر الموظف')}}
                    <select name="employee_id" class="select2-employee select2 form-control" style="width: 100%; height:36px;">
                        <option>اختار الموظف</option>
                        @foreach($employees as $employee)
                            <option  value="{{$employee->id}}" loan="{{$employee->loans}}">{{$employee->f_name }} {{$employee->l_name}}</option>
                        @endforeach
                    </select><br><br>
                    <button  class="loan-input btn btn-danger">السلف</button><br><br>
                    {{Form::label('تاريخ الدفع', 'تاريخ الدفع')}}
                    {{ Form::date('date', '', ['class' => 'form-control','id'=>'edit-loan-date'])}}<br>
                    {{Form::label('المبلغ المدفوع', 'المبلغ المدفوع')}}
                    {{Form::number('payed','',['class' => 'form-control','step'=>'0.0000000001','id'=>'edit-loan-payed'])}}<br><br>
                    {{Form::textarea('notes','',['class' => 'form-control','rows' =>3,'cols'=>10,'placeholder'=>'الملاحظات','id'=>'edit-loan-notes'])}}<br><br>
                    {{Form::submit('حفظ',['class' => 'btn btn-success btn-lg btn-block','id'=>'edit-loan'])}}
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
@endsection






