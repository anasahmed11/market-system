<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Category;

class BaseController extends Controller
{
    protected $model;

    protected $view;

    public function __construct()
    {
        View::share('searchTypes', $this->searchTypes);
    }

    public function index()
    {
        $data = $this->model::orderBy('created_at', 'desc')->paginate(10);
        $table = view("backend.$this->view.table", compact('data'))->render();

        return view("backend.$this->view.index", compact('table'));
    }

    public function search(Request $request)
    {
        if (!empty($request['search']) && array_key_exists($request['search_type'], $this->searchTypes)) {
            if ($request['search_type'] === 'id')
            {
                //die(" not cat");
                $data = $this->model::where($request['search_type'], $request['search'])->paginate(1);
            }
            else if ($request['search_type'] === 'cat_id')
            {
               // die(" cat");
                $catgories=Category::where('name', 'LIKE', "%" . $request['search'] ."%")->get();
                $data = $this->model::whereIn('cat_id',$catgories)->paginate(10);
            }
            else
            {
                //die("not cat");
                $data = $this->model::where($request['search_type'], 'LIKE', "%" . $request['search'] ."%")->paginate(10);
            }
                

        } else {
            $data = $this->model::paginate(10);
        }

        $table = view("backend.$this->view.table", compact('data'))->render();

        $res = [
            'status' => true,
            'table' => $table
        ];
        return response($res);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->model::destroy($id);
            $res = [
                'status' => true,
                'title' => 'تم بنجاح',
                'message' => 'تم الحذف'
            ];
        } catch (\PDOException $exception) {
            switch ($exception->getCode()) {
                case '23000':
                    $res = [
                        'status' => false,
                        'title' => 'فشل',
                        'message' => 'لا يمكن الحذف لانه مستخدم'
                    ];
                    break;
                default:
                    $res = [
                        'status' => false,
                        'title' => 'فشل',
                        'message' => 'لا يمكن الحذف لسبب غير معروف'
                    ];
            }
        }

        return response($res);

    }

    public function edit($id)
    {
        $object = $this->model::find($id);
        $model = view("backend.$this->view.edit", compact('object'))->render();
        $res = [
            'status' => true,
            'model' => $model
        ];

        return response($res);
    }

}
