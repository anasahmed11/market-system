<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicesType extends Model
{
    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
