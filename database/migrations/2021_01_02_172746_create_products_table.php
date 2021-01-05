<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->id();
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('code', 10);
            $table->string('name', 40);
            $table->decimal('purchase_price', 11, 0);
            $table->decimal('utility', 11, 0);
            $table->decimal('tax_type', 3, 2);
            $table->decimal('tax', 11, 0);
            $table->decimal('sale_price', 11, 0);
            $table->integer('stock')->default(0);
            $table->longText('description');
            $table->string('unit', 30);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}