<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    
    public $timestamps = false;
    protected $fillable = ['item', 'value_item'];

       function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}