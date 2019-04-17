<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    /**
     * Scope a query to only include products quantity equal 0.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */


    public function scopeOutOfStock($query)
    {
      $result =  $query->where('quantity', 0)->orWhere(function ($q) {
            $q->whereRaw('reorder_point > quantity');
            });
    return $result;
         
    }

        /**
     * Scope a query to only include products quantity equal 0.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */


    public function scopeNotOutOfStock($query)
    {
      $result =  $query->where('quantity','!=', 0)->orWhere(function ($q) {
            $q->whereRaw('reorder_point < quantity');
            });
    return $result;
         
    }

    

}
