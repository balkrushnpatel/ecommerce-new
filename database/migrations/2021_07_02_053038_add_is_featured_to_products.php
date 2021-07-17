<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsFeaturedToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Products', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default('1')->after('id');
            $table->tinyInteger('today_deal')->default(0)->after('image'); 
            $table->tinyInteger('is_featured')->default(0)->after('image'); 


            $table->foreign('created_by')
             ->references('id')->on('users')
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
        Schema::table('Products', function (Blueprint $table) {
            //
        });
    }
}
