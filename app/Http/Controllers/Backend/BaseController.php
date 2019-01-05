<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $model;

    protected $view;

    public function index()
    {
        $data = $this->model::paginate(10);
        $table = view("backend.$this->view.table", compact('data'))->render();

        return view("backend.$this->view.index", compact('table'));
    }
}
