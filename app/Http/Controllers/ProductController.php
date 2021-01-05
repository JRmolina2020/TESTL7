<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
use App\Model\ProductDetail;
use Illuminate\Support\Arr;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products = DB::table('products')  
        ->join('categories', 'products.categorie_id', '=', 'categories.id')
       ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select(
                'products.id',
                'products.code',
                'products.name',
                'products.purchase_price',
                'products.utility',
                'products.tax_type',
                'products.tax',
                'products.sale_price',
                'products.stock',
                'products.description',
                'products.unit',
                'products.status',
                'categories.name as name_categorie',
                'categories.id as idc',
                'brands.name as name_brands',
                'brands.id as idb'
            )
            ->orderBy('products.id', 'desc')->get();
        return $products;
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
         $product->categorie_id = $request->categorie_id;
         $product->brand_id=$request->brand_id;
         $product->code=$request->code;
         $product->name=$request->name;
         $product->purchase_price=$request->purchase_price;
         $product->utility=$request->utility;
         $product->tax_type=$request->tax_type;
         $product->tax=$request->tax;
         $product->sale_price=$request->sale_price;
         $product->description=$request->description;
         $product->unit=$request->unit;
         $product->save();
         $details_products=$request->details_products;
          foreach ($details_products as $ep => $det) {
               $details_products = new ProductDetail();
               $details_products->product_id = $product->id;
               $details_products->item = $det['item'];
               $details_products->value_item = $det['value_item'];
               $details_products->save();
            }
         return response()->json(['message' => 'El producto ha sido registrado'], 200);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $products = Product::find($id, ['id', 'code', 'name', 'sale_price', 'description', 'unit']);
        $products->fill([
            'categorie_id' => $request['categorie_id'],
            'brand_id' => $request['brand_id'],
            'code' => request('code'),
            'name' => request('name'),
            'purchase_price' => request('purchase_price'),
            'utility' => request('utility'),
            'tax_type' => request('tax_type'),
            'tax' => request('tax'),
            'sale_price' => request('sale_price'),
            'description' => request('description'),
            'unit' => request('unit'),

        ])->save();
//aqui iria el method    
        return response()->json(['message' => 'El producto ha sido modificado'], 201);
    }

     public function available($id)
    {
        $products = Product::findOrFail($id, ['id']);
        $products->status = '1';
        $products->save();
        return response()->json(["message" => "Ha sido activado"]);
    }
    public function locked($id)
    {
        $products = Product::findOrFail($id, ['id']);
        $products->status = '0';
        $products->save();
        return response()->json(["message" => "Ha sido Bloqueado"]);
    }

   
}