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
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price')->nullable();
            $table->string('qty')->nullable();
            $table->string('image')->nullable();
            $table->decimal('discount')->nullable();
            $table->tinyInteger('status')->default(1); 
            $table->timestamps();
          
       
            $table->foreign('cat_id')
             ->references('id')->on('categories')
             ->onDelete('cascade');
            $table->foreign('brand_id')
             ->references('id')->on('brands')
             ->onDelete('cascade');
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
