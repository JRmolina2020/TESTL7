<?php

use Illuminate\Support\Facades\Route;

Route::get('categorias', function () {
    return view('categories.index');
});

Route::get('medidas', function () {
    return view('measures.index');
});
Route::get('marcas', function () {
    return view('brands.index');
});
Route::get('productos', function () {
    return view('products.index');
});

Route::prefix('api')->group(function () {

    //categories
    Route::resource('categories', 'CategorieController')->except([
        'show', 'create', 'edit','destroy'
    ]);
    Route::put('categories/available/{id}', 'CategorieController@available')->where('id', '[0-9]+');
    Route::put('categories/locked/{id}', 'CategorieController@locked')->where('id', '[0-9]+');
    //brands
    Route::resource('brands', 'BrandController')->except([
        'show', 'create', 'edit','destroy'
    ]);
    Route::put('brands/available/{id}', 'BrandController@available')->where('id', '[0-9]+');
    Route::put('brands/locked/{id}', 'BrandController@locked')->where('id', '[0-9]+');
    //measures
    Route::resource('measures', 'MeasureController')->except([
        'show', 'create', 'edit'
    ]);
    //products
     Route::resource('products', 'ProductController')->except([
        'show', 'create', 'edit','destroy'
    ]);
     Route::put('products/available/{id}', 'ProductController@available')->where('id', '[0-9]+');;
    Route::put('products/locked/{id}', 'ProductController@locked')->where('id', '[0-9]+');;
    //details products
    Route::get('product_details/{id}', 'ProductDetailController@index')->where('id', '[0-9]+');

});