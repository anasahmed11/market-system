<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuppliersInvoice extends Model
{
    protected $with=['branch','employer'];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function products()
    {
        return $this->hasMany(SuplliersInvoiceProduct::class, 'invoice_id');
    }

    public function type()
    {
        return $this->belongsTo(InvoicesType::class, 'type_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function employer()
    {
        return $this->belongsTo(User::class, 'user_id')->with('employer');
    }

}
