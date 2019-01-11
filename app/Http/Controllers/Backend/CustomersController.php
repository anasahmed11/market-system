<?php

namespace App\Http\Controllers\Backend;

use App\Customer;
use App\Debt;
use App\DebtsType;
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
            'location' => 'العنوان'
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
                'status' => true,
                'title' => 'حدث خطاء',
                'message' => 'لم يتم الحفظ'
            ];
        }

        return response($res);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
