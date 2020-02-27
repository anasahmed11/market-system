<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Employee;
use App\Invoice;
use App\InvoiceProduct;
use App\Product;
use App\Shift;
use App\SuppliersInvoice;
use App\SuplliersInvoiceProduct;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class ReportController extends Controller
{

    public function __construct()
    {


    }

    /*تفاصيل المستخدم*/
    public function get_user_details($id)
    {
        $data =Employee::where('id','=',$id)->get();
        return response()->json($data);
    }
      /*حاله المخزون*/
    public function getOutOfStock()
    {
        $data =DB::select('SELECT * FROM `products` WHERE `quantity` <= `reorder_point`');
        $categories=Category::all();
       return view('backend/reports/outOfStock')->with('data',$data)->with('categories',$categories);
    }
    public function empty_stock()
    {
        $data =Product::where('quantity','=',0)->get();
        return response()->json($data);
    }
    public function full_stock()
    {
        $data =Product::where('quantity','>',0)->get();
        return view('backend/reports/full-stock')->with('data',$data);
    }
    public function full_stock_ajax()
    {
        $data =Product::where('quantity','>',0)->get();
        return response()->json($data);
    }

    /*------------------------*/
    /* فواتير المشتريات*/
    public function all_invoices(){
        $data=SuppliersInvoice::all();
        return view('backend/invoices/all-s-invoices')->with('data',$data);
    }
    /* تفاصيل فواتير المشتريات*/
    public function invoice_products($id){
        $details=SuplliersInvoiceProduct::where('invoice_id', '=',$id )->get();
        return  response()->json($details);
    }
    /*----------------------------*/
    /* فواتير اليوم*/
    public function today_invoices(){
        $data=Invoice::whereDate('date', Carbon::today())->get();
        $shifts=Shift::all();
        return view('backend/invoices/today-invoices')->with('data',$data)->with('shifts',$shifts);
    }
    public function today_invoices_ajax(){
        $data=Invoice::whereDate('date', Carbon::today())->get();
        $sum=Invoice::whereDate('date', Carbon::today())->sum('total');
        $payed=Invoice::whereDate('date', Carbon::today())->sum('payed');
        return response()->json(array(
            'data' =>$data,
            'sum' =>$sum,
            'payed' =>$payed,
        ));
    }
    public function today_invoices_shift($id){
        $data=Invoice::join('employees', 'invoices.user_id', '=', 'employees.id')
            ->select('invoices.*')
            ->where('employees.shift_id',$id)->whereDate('invoices.date', Carbon::today())
            ->get();
        $sum=Invoice::join('employees', 'invoices.user_id', '=', 'employees.id')
            ->select('invoices.*')
            ->where('employees.shift_id',$id)->whereDate('invoices.date', Carbon::today())
            ->sum('invoices.total');
        $payed=Invoice::join('employees', 'invoices.user_id', '=', 'employees.id')
            ->select('invoices.*')
            ->where('employees.shift_id',$id)->whereDate('invoices.date', Carbon::today())
            ->sum('invoices.payed');
        return response()->json(array(
            'data' =>$data,
            'sum' =>$sum,
            'payed' =>$payed,
        ));
    }
    /*تفاصيل فواتير االبيع*/
    public function c_invoice_products($id){
        $details=InvoiceProduct::where('invoice_id', '=',$id )->get();
        return  response()->json($details);
    }
    /*----------------------------*/
    /*فواتير اورديه*/
    public function shift_1(){
        $data=Invoice::join('employees', 'invoices.user_id', '=', 'employees.id')
            ->select('invoices.*')
            ->where('employees.shift_id',1)
            ->get();
        $shifts=Shift::all();
        return view('backend/invoices/shifts/shift-1')->with('data',$data)->with('shifts',$shifts);

    }
    public function shift($id){
        $data=Invoice::join('employees', 'invoices.user_id', '=', 'employees.id')
            ->select('invoices.*')
            ->where('employees.shift_id',$id)
            ->get();
        $sum=Invoice::join('employees', 'invoices.user_id', '=', 'employees.id')
            ->select('invoices.*')
            ->where('employees.shift_id',$id)
            ->sum('invoices.total');
        $payed=Invoice::join('employees', 'invoices.user_id', '=', 'employees.id')
            ->select('invoices.*')
            ->where('employees.shift_id',$id)
            ->sum('invoices.payed');
        return response()->json(array(
            'data' =>$data,
            'sum' =>$sum,
            'payed' =>$payed,
        ));

    }
    /*---------------------- most selling products*/
    public function selling_products(){
        $data=InvoiceProduct::groupBy('product_id','category_id')->selectRaw('product_id ,category_id,SUM(quantity) as quantity')->orderByRaw('SUM(quantity) DESC')->get();
        return view('backend/invoices/selling-products')->with('data',$data);
    }

    public function filter(Request $request)
    {


    }



}
