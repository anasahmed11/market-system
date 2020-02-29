<?php

namespace App\Http\Controllers\Backend;

use App\Debt;
use App\DebtsType;
use App\Http\Requests\AddDebtSupplier;
use App\Http\Requests\StoreSupplier;
use App\Supplier;
use App\SupplierDebt;
use App\SuppliersInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Validator;

class SuppliersController extends BaseController
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
        $this->model = Supplier::class;
        $this->view = 'suppliers';

    }

    public function debts(Supplier $supplier)
    {
        $data = $supplier->debts()->paginate(10);
        $table = view("backend.$this->view.debts.table", compact('data'))->render();

        return view("backend.$this->view.debts.index", compact('table', 'supplier'));
    }

    public function store(StoreSupplier $req)
    {
        $supplier = new Supplier();
        $supplier->f_name = $req['f_name'];
        $supplier->l_name = $req['l_name'];
        $supplier->nickname = $req['nickname'];
        $supplier->location = $req['location'];
        $supplier->phone = $req['phone'];

        if ($supplier->save()) {
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

    public function update(StoreSupplier $request, Supplier $supplier)
    {
        $supplier->f_name = $request['f_name'];
        $supplier->l_name = $request['l_name'];
        $supplier->nickname = $request['nickname'];
        $supplier->location = $request['location'];
        $supplier->phone = $request['phone'];

        if ($supplier->save()) {
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

    public function addDebt(AddDebtSupplier $request, Supplier $supplier)
    {
        if (!DebtsType::find($request['debt_type']))
            return [
                'status' => false,
                'title' => 'حدث خطاء',
                'message' => 'يجب اختيار النوع الصحيح'
            ];

        $debt = new SupplierDebt();
        $debt->debts_types_id = $request['debt_type'];
        $debt->note = $request['description'];
        $debt->value = $request['value'];
        $debt->supplier_id = $supplier->id;
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

    public function removeDebt(AddDebtSupplier $request, Supplier $supplier)
    {
        if (!DebtsType::find($request['debt_type']))
            return [
                'status' => false,
                'title' => 'حدث خطاء',
                'message' => 'يجب اختيار النوع الصحيح'
            ];

        $debt = new SupplierDebt();
        $debt->debts_types_id = $request['debt_type'];
        $debt->note = $request['description'];
        $debt->value = $request['value'] * -1;
        $debt->supplier_id = $supplier->id;
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
    public function supp_invoices($id){
        $details=SuppliersInvoice::where('supplier_id', '=',$id )->get();
        return  response()->json($details);
    }
    public function edit_payed(Request $request,$id){
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $details = SuppliersInvoice::find($id);
            $details->payed = $details->payed + $request->input('payed');
            $details->remaining=$details->remaining-$request->input('payed');
            $debt = new SupplierDebt();
            $debt->debts_types_id = 2;
            $debt->note = $details->slug;
            $debt->value = $request->input('payed') * -1;
            $debt->supplier_id = $details->supplier_id;
            $debt->date = Carbon::today();
            $debt->save();
            $details->save();
            return response()->json($details);
        }
    }
    public function total_ind(){
        $total=DB::table('suppliers')->sum('total_indebtedness');
        return response()->json($total);
    }


}
