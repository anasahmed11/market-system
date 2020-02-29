<?php
namespace App\Http\Controllers\Backend;

use App\Employee;
use App\Salary;
use App\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Response;
use DB;
use Validator;

class LoansController extends Controller
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
        ];
    public function index()
    {
        $employees=Employee::all();
        $data=Loan::all();
        return view('backend/employees/loan')->with('data',$data)->with('employees',$employees);
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
            $loan = new Loan();
            $loan->user_id = $request->input('user_id');
            $loan->employee_id = $request->input('employee_id');
            $loan->user_id = $request->input('user_id');
            $loan->date = $request->input('date');
            $loan->payed= $request->input('payed');
            $employee=Employee::find($request->input('employee_id'));
            $employee->loans=$employee->loans+$request->input('payed');
            $employee->save();
            $loan->notes = $request->input('notes');
            $loan->save();
            return response()->json($loan);
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
            $loan = Loan::find($id);
            $employee=Employee::find($request->input('employee_id'));
            $employee->loans=$employee->loans - $loan->payed;
            $loan->user_id = $request->input('user_id');
            $loan->employee_id = $request->input('employee_id');
            $loan->user_id = $request->input('user_id');
            $loan->date = $request->input('date');
            $loan->payed= $request->input('payed');
            $loan->notes = $request->input('notes');
            $employee->loans=$employee->loans+$request->input('payed');
            $employee->save();
            $loan->save();
            return response()->json($loan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$emp_id)
    {
        $loan = Loan::find($id);
        $employee=Employee::find($emp_id);
        $employee->loans=$employee->loans - $loan->payed;
        $employee->save();
        $loan->delete();
        return response()->json($loan);
    }
}
