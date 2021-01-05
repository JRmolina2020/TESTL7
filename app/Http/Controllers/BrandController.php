<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = DB::table('brands')->select('id', 'name', 'status')->orderBy('id', 'desc')->get();
        return $brands;
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Brand::create([
            'name' => $request['name'],
        ]);
        return response()->json(['message' => 'La marca ha sido creada'], 200);
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
        $brands = Brand::find($id, ['id', 'name']);
        $brands->fill([
            'name' => request('name'),
        ])->save();
        return response()->json(['message' => 'La marca ha sido modificada'], 201);
    }



    public function available($id)
    {
        $brands = Brand::findOrFail($id, ['id']);
        $brands->status = '1';
        $brands->save();
        return response()->json(["message" => "Ha sido activada"]);
    }
    public function locked($id)
    {
        $brands = Brand::findOrFail($id, ['id']);
        $brands->status = '0';
        $brands->save();
        return response()->json(["message" => "Ha sido Bloqueada"]);
    }
}