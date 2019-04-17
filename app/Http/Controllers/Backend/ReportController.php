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
        $table = view("backend.reports.table", compact('data'))->render();

        return view("backend.reports.stockState", compact('table'));
    }

      /**
     * get store state .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getOutOfStock(Request $request)
    {
        

        $data =Product::outOfStock()->paginate(10);
    
           // dump($data);die;
        $table = view("backend.reports.table", compact('data'))->render();

       return view("backend.reports.outOfStock", compact('table'));
    }


    public function filter(Request $request)
    {
       // return true;
        //die("sa");
        if (!empty($request['flag'])) {
            if ($request['flag'] === 'all')
            //allproducta
                $data =  Product::orderBy('created_at', 'desc')->paginate(10);

            else  if ($request['flag'] === 'out')
            //out of stock products

                $data =Product::outOfStock()->paginate(10);

            else  if ($request['flag'] === 'notOut')
            //avilable products

             $data =Product::notOutOfStock()->paginate(10);
            
        } else {
            $data =  Product::orderBy('created_at', 'desc')->paginate(10);
        }

        $table = view("backend.reports.table", compact('data'))->render();

        $res = [
            'status' => true,
            'table' => $table
        ];
        return response($res);
    }

   

}
