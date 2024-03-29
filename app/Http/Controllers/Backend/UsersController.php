<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreUserRequest;


class UsersController extends BaseController
{
    protected $searchTypes;
    public function __construct()
    {
        $this->searchTypes = [
            'email' => 'البريد الالكترونى',

            'id' => 'الكود'
        ];
        $this->model = User::class;
        $this->view = 'users';

        View::share('employees', Employee::all());
        View::share('users', User::all());
        parent::__construct();
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $employee = new User($request->except('_token'));

        if ($employee->save()) {
            $res = [
                'status' => true,
                'title' => 'تم بنجاح',
                'message' => 'تم الحفظ'
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
    public function update(StoreUserRequest $request, User $user)
    {
        if ($user->fill($request->except('_token'))->save()) {
            $res = [
                'status' => true,
                'title' => 'تم بنجاح',
                'message' => 'تم الحفظ'
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
