<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


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
        $data = $this->model::paginate(10);
        $table = view("backend.$this->view.table", compact('data'))->render();

        return view("backend.$this->view.index", compact('table'));
    }

    public function search(Request $request)
    {
        if (!empty($request['search']) && array_key_exists($request['search_type'], $this->searchTypes)) {
            $data = $this->model::where($request['search_type'], 'LIKE', "%" . $request['search'] ."%")->paginate(10);
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

}
