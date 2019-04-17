<?php


namespace App\Http\Controllers\Backend;

use App\Shift;
use Illuminate\Http\Request;
use App\Http\Requests\StoreShift;

class ShiftController extends BaseController
{
    

    protected $searchTypes;

    public function __construct()
    {
        $this->searchTypes = [
            'from' => 'من',
            'to' => 'إلى'
        ];
        parent::__construct();
        $this->model = Shift::class;
        $this->view = 'Shifts';

    }



    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShift $request)
    {
        $shift = new Shift($request->except('_token'));

        if ($shift->save()) {
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
     * Display the specified resource.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShift $request, Shift $shift)
    {
        if ($shift->fill($request->except('_token'))->save()) {
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
