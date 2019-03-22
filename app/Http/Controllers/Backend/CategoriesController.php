<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{
    public function __construct()
    {
        $this->searchTypes = [
            'name' => 'الاسم',
            'id' => 'الكود'
        ];
        parent::__construct();
        $this->model = Category::class;
        $this->view = 'categories';
    }

    public function getAllTypes()
    {
        $view = view('common.forms.select', array(
            'options'=> Category::whereNull('parent')->get(),
            'group' => true,
            'value'=> 'id',
            'input_label'=> 'الاصناف',
            'label'=> 'name',
            'name'=> 'type'))->render();
        return response($view);
    }


    public function getAllTypesEdit($id)
    {
        $view = view('common.forms.select', array(
            'options'=> Category::whereNull('parent')->get(),
            'group' => true,
            'value'=> 'id',
            'input_label'=> 'الاصنف',
            'label'=> 'name',
            'object'=> Product::find($id)->cat_id,
            'name'=> 'type'))->render();
        return response($view);
    }

    public function getAllTypesEditCategories($id)
    {
        $view = view('common.forms.select', array(
            'options'=> Category::whereNull('parent')->get(),
            'value'=> 'id',
            'input_label'=> 'الاصنف',
            'label'=> 'name',
            'object'=> Category::find($id)->parent,
            'name'=> 'type'))->render();
        return response($view);
    }

    public function getAllParents()
    {
        $view = view('common.forms.select', array(
            'options'=> Category::whereNull('parent')->get(),
            'value'=> 'id',
            'input_label'=> 'الاصناف',
            'label'=> 'name',
            'name'=> 'type'))->render();
        return response($view);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\Response
    {
        $category = new Category();
        $category->name = $request['name'];
        $category->description = $request['description'];
        if (isset($request['type'])) $category->parent = $request['type'];
        if ($category->save()) {
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request['name'];
        $category->description = $request['description'];
        if (isset($request['type'])) $category->parent = $request['type'];
        if ($category->save()) {
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
}
