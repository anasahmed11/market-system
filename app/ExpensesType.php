<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesType extends Model
{
    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
