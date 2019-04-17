<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuppliersInvoice extends Model
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
