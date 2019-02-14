<?php

namespace App\Http\Controllers\Backend;

use App\Branch;
use App\Category;
use App\Customer;
use App\InvoicesType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class InvoicesController extends Controller
{

    public function index()
    {
        return 'index';
    }


    /**
     * @param InvoicesType $invoicesType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Throwable
     */
    public function create(InvoicesType $invoicesType): View
    {
        if (!$invoicesType) {
            return redirect()->route('invoices.index');
        }

        switch ($invoicesType->slug) {
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

    public function store(Request $request)
    {
        return $request;
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
