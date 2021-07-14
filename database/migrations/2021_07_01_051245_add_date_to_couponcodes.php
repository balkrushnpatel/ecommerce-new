<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToCouponcodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('couponcodes', function (Blueprint $table) {
            $table->date('valid_date')->nullable()->after('discount');
            $table->tinyInteger('discount_on')->default(1)->comment('1=>All Products,2=>Category,3=>SubCategory,4=>Product');
            $table->string('cat_id')->nullable()->after('discount');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('couponcodes', function (Blueprint $table) {
            //
        });
    }
}
