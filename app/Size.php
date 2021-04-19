<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
