<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('blog_cat_id')->nullable();
            $table->string('image')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('author')->nullable();
            $table->tinyInteger('status')->default(1); 
            $table->timestamps();
          
       
            $table->foreign('blog_cat_id')
             ->references('id')->on('blog_cats')
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
        Schema::dropIfExists('blogs');
    }
}
