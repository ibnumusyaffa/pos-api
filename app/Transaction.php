<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product', 'transaction_product')->withPivot('harga', 'qty', 'total');
    }
}
