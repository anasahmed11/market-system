<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id','employee_id','expenses_type_id','received_amount','paid_amount','payment_date','notes'];


     /**
     * Get the  Expense user .
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }


     /**
     * Get the  Expense employee  .
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee','employee_id');
    }

    /**
     * Get the  Expense type  .
     */
    public function expenseType()
    {
        return $this->belongsTo('App\Expenses_type','expenses_type_id');
    }

}
