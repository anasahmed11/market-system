<?php

namespace App\Http\Controllers\Backend;

use App\Employee;
use App\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Response;
use DB;
use Validator;
class SalariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $rules =
        [
            'user_id' => 'required|exists:users,id',
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|',
            'payed' => 'required|',
            'remaining' => 'required|',
        ];
    public function index()
    {
        $employees=Employee::all();
        $data=Salary::all();
        return view('backend/employees/salary')->with('data',$data)->with('employees',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $salary = new Salary();
            $salary->user_id = $request->input('user_id');
            $salary->employee_id = $request->input('employee_id');
            $salary->user_id = $request->input('user_id');
            $salary->date = $request->input('date');
            $salary->payed= $request->input('payed');
            $salary->remaining = $request->input('remaining');
            $salary->notes = $request->input('notes');
            $salary->save();
            return response()->json($salary);
        }
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
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $salary = Salary::find($id);
            $salary->user_id = $request->input('user_id');
            $salary->employee_id = $request->input('employee_id');
            $salary->user_id = $request->input('user_id');
            $salary->date = $request->input('date');
            $salary->payed= $request->input('payed');
            $salary->remaining = $request->input('remaining');
            $salary->notes = $request->input('notes');
            $salary->save();
            return response()->json($salary);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary = Salary::find($id);
        $salary->delete();
        return response()->json($salary);
    }
}
