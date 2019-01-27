<?php

namespace App\Http\Controllers\Backend;

use App\Customer;
use App\Debt;
use App\DebtsType;
use App\Http\Requests\AddDebtCustomer;
use App\Http\Requests\StoreCustomer;
use http\Client\Response;
use Illuminate\Http\Request;

class CustomersController extends BaseController
{

    protected $searchTypes;

    public function __construct()
    {
        $this->searchTypes = [
            'f_name' => 'الاسم الاول',
            'l_name' => 'الاسم الاخير',
            'nickname' => 'اسم الشهرة',
            'phone' => 'الموبيل',
            'location' => 'العنوان',
            'id' => 'الكود'
        ];
        parent::__construct();
        $this->model = Customer::class;
        $this->view = 'customers';

    }

    public function debts(Customer $customer)
    {
        $data = $customer->debts()->paginate(10);
        $table = view("backend.$this->view.debts.table", compact('data'))->render();

        return view("backend.$this->view.debts.index", compact('table', 'customer'));
    }

    public function store(StoreCustomer $req)
    {
        $customer = new Customer();
        $customer->f_name = $req['f_name'];
        $customer->l_name = $req['l_name'];
        $customer->nickname = $req['nickname'];
        $customer->location = $req['location'];
        $customer->phone = $req['phone'];

        if ($customer->save()) {
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

    public function show($id)
    {
        //
    }

    public function update(StoreCustomer $request, Customer $customer)
    {
        $customer->f_name = $request['f_name'];
        $customer->l_name = $request['l_name'];
        $customer->nickname = $request['nickname'];
        $customer->location = $request['location'];
        $customer->phone = $request['phone'];

        if ($customer->save()) {
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

    public function addDebt(AddDebtCustomer $request, Customer $customer)
    {
        if (!DebtsType::find($request['debt_type']))
            return [
                'status' => false,
                'title' => 'حدث خطاء',
                'message' => 'يجب اختيار النوع الصحيح'
            ];

        $debt = new Debt();
        $debt->debts_types_id = $request['debt_type'];
        $debt->note = $request['description'];
        $debt->value = $request['value'];
        $debt->customer_id = $customer->id;
        $debt->date = $request['date'];

        if ($debt->save()) {
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
}
