<?php

namespace App\Http\Controllers\Backend;

use App\Expenses_type;
use App\Http\Requests\ExpenseTypeRequest;
use Illuminate\Http\Request;
use App\Expenses_type as ExpensesType;

class ExpenseTypeController extends BaseController
{
    protected $searchTypes;

    public function __construct()
    {
        $this->searchTypes = [
            'name' => 'الاسم',
            'id' => 'الكود'
        ];
        parent::__construct();
        $this->model = ExpensesType::class;
        $this->view = 'expenses_type';
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseTypeRequest $request)
    {
        $ex = new ExpensesType($request->except('_token'));
        if ($ex->save()) {
            $res = [
                'status' => true,
                'title' => 'عملية الحفظ',
                'message' => 'تم الحفظ بنجاح'
            ];
        } else {
            $res = [
                'status' => false,
                'title' => 'حدث خطاء',
                'message' => 'لم يتم الحفظ'
            ];
        }

        return response($res);
    }


    public function update(ExpenseTypeRequest $request, $expense)
    {
        $expense = Expenses_type::find($expense);
        $expense->name = $request['name'];
        if($expense->save()) {
            $res = [
                'status' => true,
                'title' => 'عملية الحفظ',
                'message' => 'تم التعديل بنجاح '
            ];
        } else {
            $res = [
                'status' => false,
                'title' => 'حدث خطاء',
                'message' => 'لم يتم الحفظ'
            ];
        }
//dd($res);
        return response($res);
    }
}
