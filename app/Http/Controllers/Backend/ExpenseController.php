<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreExpense;
use Illuminate\Http\Request;
use App\Employee;
use App\Expense;
use App\ ExpensesType as ExpensesType;
use Auth;
use Illuminate\Support\Facades\View;

class ExpenseController extends BaseController
{

    protected $searchTypes;


    public function __construct()
    {
        $this->searchTypes = [
            'payment_date' => 'تاريخ الدفع',
            'notes' => 'ملاحظات',
         ];
        parent::__construct();
        $this->model = Expense::class;
        $this->view = 'expenses';

      
        
        
        View::share('expenses_type', ExpensesType::all());
        

    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpense $request)
    {
        //$request->user_id=Auth::user()->id;
        $request['user_id'] = Auth::user()->id;
        //dump($request->except('_token'));die();
        $expense = new Expense($request->except('_token'));

        if ($expense->save()) {
            $res = [
                'status' => true,
                'title' => 'تم بنجاح',
                'message' => 'تم الحفظ'
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

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(StoreExpense $request, Expense $expense)
    {
        
        
          $request['user_id'] = Auth::user()->id;
        
        if ($expense->fill($request->except('_token'))->save()) {
            $res = [
                'status' => true,
                'title' => 'تم بنجاح',
                'message' => 'تم الحفظ'
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
