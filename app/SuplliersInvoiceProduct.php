<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuplliersInvoiceProduct extends Model
{
    protected $with = ['product','category'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function invoicess()
    {
        return $this->hasMany(Product::class, 'id');
    }
}
