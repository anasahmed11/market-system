<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';
    public $timestamps = false;
    protected $with =['user','employer'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->with('employer');
    }
    public function employer()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
