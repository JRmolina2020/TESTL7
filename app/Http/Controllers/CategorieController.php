<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->select('id', 'name', 'status')->orderBy('id', 'desc')->get();
        return $categories;
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Categorie::create([
            'name' => $request['name'],
        ]);
        return response()->json(['message' => 'La categoria ha sido creada'], 200);
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
        $categories = Categorie::find($id, ['id', 'name']);
        $categories->fill([
            'name' => request('name'),
        ])->save();
        return response()->json(['message' => 'La categoria ha sido modificada'], 201);
    }



    public function available($id)
    {
        $categories = Categorie::findOrFail($id, ['id']);
        $categories->status = '1';
        $categories->save();
        return response()->json(["message" => "Ha sido activado"]);
    }
    public function locked($id)
    {
        $categories = Categorie::findOrFail($id, ['id']);
        $categories->status = '0';
        $categories->save();
        return response()->json(["message" => "Ha sido Bloqueado"]);
    }
}