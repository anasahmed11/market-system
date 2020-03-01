<?php

namespace App\Http\Controllers\Backend;

use App\Customer;
use App\Debt;
use App\DebtsType;
use App\Http\Requests\AddDebtCustomer;
use App\Http\Requests\StoreCustomer;
use App\SupplierDebt;
use App\SuppliersInvoice;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Validator;


class CustomersController extends BaseController
{

    protected $searchTypes;
    protected $rules =
        [
            'payed' => 'required|',
        ];

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

    public function removeDebt(AddDebtCustomer $request, Customer $customer)
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
        $debt->value = $request['value'] * -1;
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
    public function cust_invoices($id){
        $details=Invoice::where('customer_id', '=',$id )->get();
        return  response()->json($details);
    }
    public function edit_payed(Request $request,$id){
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $details = Invoice::find($id);
            $details->payed = $details->payed + $request->input('payed');
            $details->remaining=$details->remaining-$request->input('payed');
            $debt = new Debt();
            $debt->debts_types_id = 2;
            $debt->note = $details->slug;
            $debt->value = $request->input('payed') * -1;
            $debt->customer_id = $details->customer_id;
            $debt->date = Carbon::today();
            $debt->save();
            $details->save();
            return response()->json($details);
        }
    }
    public function total_ind(){
        $total=DB::table('customers')->sum('total_indebtedness');
        return response()->json($total);
    }
}
