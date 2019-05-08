<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesType extends Model
{
    protected $table = "expenses_types";
    protected $fillable = ['name'];
    
    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
