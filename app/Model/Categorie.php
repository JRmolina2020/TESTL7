<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'name',
    ];
    function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}