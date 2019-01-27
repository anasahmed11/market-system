<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'cat_id');
    }

    public function rowParent()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function rowChilds()
    {
        return $this->hasMany(Category::class, 'parent');
    }
}
