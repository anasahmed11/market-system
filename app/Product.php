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
}
