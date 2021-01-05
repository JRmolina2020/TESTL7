<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\ProductDetail;


class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $details_product = DB::table('product_details')
        ->select('item', 'value_item','id AS id_details','product_id')
         ->where('product_id', $id)
        ->orderBy('id', 'desc')->get();
        return $details_product;
    }


}