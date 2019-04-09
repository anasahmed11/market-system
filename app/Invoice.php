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

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function type()
    {
        return $this->belongsTo(InvoicesType::class, 'type_id');
    }

    public function products()
    {
        return $this->hasMany(InvoiceProduct::class, 'invoice_id');
    }
}
