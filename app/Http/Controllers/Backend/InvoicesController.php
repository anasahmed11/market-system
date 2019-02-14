<?php

namespace App\Http\Controllers\Backend;

use App\Branch;
use App\Category;
use App\Customer;
use App\Debt;
use App\DebtsType;
use App\Invoice;
use App\InvoiceProduct;
use App\InvoicesType;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{

    public function index()
    {
        return 'index';
    }


    public function create(InvoicesType $invoicesType)
    {
        if (!$invoicesType) return redirect()->route('invoices.index');

        switch ($invoicesType->slug) {
            case 'selling-2':
            case 'selling-1':
                $customerView = view('common.forms.select', array(
                    'options'=> Customer::all(),
                    'value'=> 'id',
                    'input_label'=> 'اسم العميل',
                    'label'=> 'nickname',
                    'name'=> 'customer'))->render();
                $categoryWithProducts = Category::Where('parent', '!=', null)
                                                    ->orderBy('name', 'asc')
                                                    ->get();

                $view = view('backend.invoices.create', [
                    // @TODO pagination or search
                    'region_top_right'=> $customerView,
                    'branches'=> Branch::all(),
                    'invoicesType'=> $invoicesType,
                    'categoryWithProducts'=> $categoryWithProducts
                ]);
        }

        return $view;
    }

    /**
     * @param Request $request
     * @param InvoicesType $invoicesType
     * @return array
     */
    public function store(Request $request, InvoicesType $invoicesType): array
    {
        if (!$invoicesType) return ['status' => false, 'title' => 'حدث خطاء', 'message' => 'لم يتم تحديد نوع الفاتورة'];

        $errors = [];

        $customer = Customer::findOrFail($request['customer_id']);
        $branch = Branch::findOrFail($request['branch_id']);

        if (!$customer) {
            $errors[] = 'لم يتم العثور علي العميل';
        }
        if (!$branch) {
            $errors[] = 'لم يتم العثور علي الفرع';
        }

        if (count($errors)) {
            return ['status' => false, 'title' => 'حدث خطاء', 'message' => implode(' , ',$errors)];
        }
        // save Invoice info
        $invoice = new Invoice();
        $invoice->slug = time() . '-' . $branch->id . '-' . Auth::user()->id . '-';
        $invoice->type_id = $invoicesType->id;
        $invoice->user_id = Auth::user()->id;
        $invoice->customer_id = $customer->id;
        $invoice->branch_id = $branch->id;
        $invoice->date = $request['date'] ?$request['date'] : date('Y-m-d h:i:s');
        $invoice->added_value = $request['added_value'];
        $invoice->discount_value = $request['discount_value'];
        $invoice->payed = $request['payed'];
        $invoice->remaining = $request['remaining'];
        $invoice->note = $request['note'];

        try {
            $invoice->saveOrFail();
        } catch (\Throwable $e) {
            $errors[] = 'حدث خطاء في حفظ الفاتورة';
        }

        if (count($errors)) {
            return ['status' => false, 'title' => 'حدث خطاء', 'message' => implode(' , ',$errors)];
        }

        // save Invoice Product
        $invoiceProduct = new InvoiceProduct();
        foreach ($request['products'] as $invProduct) {
            if (!$product = Product::findOrFail($invProduct['id'])) continue;

            $invoiceProduct->invoice_id = $invoice->id;
            $invoiceProduct->product_id = $product->id;
            $invoiceProduct->category_id = $product->cat_id;
            $invoiceProduct->quantity = $invProduct['quantity'] > $product->quantity ?
                $product->quantity : $invProduct['quantity']; // @TODO quantity validation
            if ($invoicesType->slug === 'selling-1') {
                $invoiceProduct->price = $product->price;
            } elseif($invoicesType->slug === 'selling-2') {
                $invoiceProduct->price = $product->price2;
            }
            $invoiceProduct->sub_total = $invoiceProduct->price * $invoiceProduct->quantity;
            try {
                if (!$invoiceProduct->saveOrFail()) {
                    $errors[] = " {$product->name}حدث خطاء في حفظ ";
                    continue;
                }
            } catch (\Throwable $e) {
                $errors[] = " {$product->name}حدث خطاء في حفظ ";
                $errors[] = $e->getMessage();
                //TODO Error Log
            }
            $invoice->sub_total += $invoiceProduct->sub_total; // calculate invoice sub total
            $product->quantity -= $invoiceProduct->quantity; // calculate stock
            $product->save();
        }

        $invoice->total = $invoice->sub_total + $invoice->added_value - $invoice->discount_value; // calculate invoice total
//
        try{
            $debt = new Debt();
//            $debtType = DebtsType::find(['slug'=> 'type-1']);
            $debt->debts_types_id = 1;
            $debt->customer_id = $customer->id;
            $debt->note = $invoice->slug . $invoice->id;
            $debt->value = $invoice->total - $invoice->payed;
            $debt->date = date('Y-m-d h:i:s');
            $debt->save();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            if (!$invoice->saveOrFail()) $errors[] = 'حدث خطاء في حفظ اجمالي افاتورة';
        } catch (\Throwable $e) {
            $errors[] = "{$product->name}حدث خطاء في حفظ ";
            //TODO Error Log
        }

        if (count($errors)) {
            return ['status' => false, 'title' => 'حدث خطاء', 'message' => implode(' , ',$errors)];
        }

        // all done
        return [
            'status' => true,
            'title' => 'تم الحفظ',
            'message' =>  $invoice->slug . $invoice->id . ' تم حفظ الفاتورة بكود '
        ];
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
