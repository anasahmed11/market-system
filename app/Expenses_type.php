<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses_type extends Model
{
    protected $table = "expenses_types";
    protected $fillable = ['name'];
}
