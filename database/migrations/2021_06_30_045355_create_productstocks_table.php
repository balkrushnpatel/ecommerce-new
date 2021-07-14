<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductstocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productstocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('subcat_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('qty')->nullable();
            $table->decimal('price')->nullable();
            $table->string('note')->nullable();
            $table->string('total')->nullable();
            $table->tinyInteger('status')->default(1); 
            $table->timestamps();
          
       
            $table->foreign('product_id')
             ->references('id')->on('products')
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
        Schema::dropIfExists('productstocks');
    }
}
