<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
       protected $fillable = [
        'categorie_id','brand_id', 'code', 'name', 'purchase_price', 'utility', 'tax_type', 'tax', 'sale_price',
        'description', 'unit'
    ];

      function categorie()
    {
        return $this->belongsTo('App\Model\Categorie');
    }
    function brand()
    {
        return $this->belongsTo('App\Model\Brand');
    }
     function product_details()
    {
        return $this->hasMany('App\Model\ProductDetail');
    }
}