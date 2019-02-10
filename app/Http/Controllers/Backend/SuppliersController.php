<?php

namespace App\Http\Controllers\Backend;

use App\Debt;
use App\DebtsType;
use App\Http\Requests\AddDebtSupplier;
use App\Http\Requests\StoreSupplier;
use App\Supplier;
use App\SupplierDebt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuppliersController extends BaseController
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


}
