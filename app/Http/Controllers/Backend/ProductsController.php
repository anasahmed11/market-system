<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Validator;
use Illuminate\Support\Facades\View;

class ProductsController extends BaseController
{

    public function __construct()
    {
        $this->searchTypes = [
            'name' => 'الاسم',
            'description' => 'التفاصيل',
            'id' => 'الكود',
        ];
        parent::__construct();
        $this->model = Product::class;
        $this->view = 'products';
        View::share('categories', Category::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->cat_id = $request['type'];
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->price2 = $request['price2'];
        $product->quantity = $request['quantity'];
        $product->description = $request['description'];
        $product->reorder_point	 = $request['reorder_point'];

        if (!$product->save()) {
            $res = [
                'status' => false,
                'title' => 'حدث خطاء',
                'message' => 'لم يتم الحفظ'
            ];
        } else {
            $res = [
                'status' => true,
                'title' => 'تم بنجاح',
                'message' => 'تم الحفظ'
            ];
        }
        return response($res);
    }

    public function getAllTypesEdit($id)
    {
        $view = view('common.forms.select', array(
            'options'=> Category::whereNull('parent')->get(),
            'group' => true,
            'value'=> 'id',
            'input_label'=> 'الاصنف',
            'label'=> 'name',
            'object'=> $id,
            'name'=> 'type'))->render();
        return response($view);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product): \Illuminate\Http\Response
    {
        $product->cat_id = $request['type'];
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->price2 = $request['price2'];
        $product->quantity = $request['quantity'];
        $product->description = $request['description'];
        $product->reorder_point	 = $request['reorder_point'];

        if (!$product->save()) {
            $res = [
                'status' => false,
                'title' => 'حدث خطاء',
                'message' => 'لم يتم الحفظ'
            ];
        } else {
            $res = [
                'status' => true,
                'title' => 'تم بنجاح',
                'message' => 'تم الحفظ'
            ];
        }
        return response($res);
    }

}
