<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['f_name','l_name','phone','location','hiring_date','salary','branche_id','shift_id'];


    /**
     * Get the  employee brance .
     */
    public function Branch()
    {
        return $this->belongsTo('App\Branch','branche_id');
    }


    
    /**
     * Get the  employee shift .
     */
    public function shift()
    {
        return $this->belongsTo('App\Shift','shift_id');
    }
}
