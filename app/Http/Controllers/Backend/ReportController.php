<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nexmo\Response;

class ReportController extends Controller
{

    public function __construct()
    {
        

    }

     /**
     * get store state .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStoreState(Request $request)
    {
        $data = Product::orderBy('created_at', 'desc')->paginate(10);
        $table = view("backend.products.table", compact('data'))->render();

        return view("backend.products.StoreState", compact('table'));
    }

      /**
     * get store state .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getOutOfStock(Request $request)
    {
        

        $data =Product::outOfStock()->orWhere(function ($query) {
            $query->whereRaw('reorder_point > quantity');
            })->paginate(10);
    
           // dump($data);die;
        $table = view("backend.reports.table", compact('data'))->render();

       return view("backend.reports.outOfStock", compact('table'));
    }

   

}
