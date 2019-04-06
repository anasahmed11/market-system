<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property false|string date
 * @property  branch_id
 * @property  customer_id
 */
class Invoice extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
