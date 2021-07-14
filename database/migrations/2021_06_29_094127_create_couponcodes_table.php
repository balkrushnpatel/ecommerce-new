<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couponcodes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1=>Amount,2=>Percentage');
            $table->decimal('discount')->nullable();
            $table->tinyInteger('status')->default(1); 
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
        Schema::dropIfExists('couponcodes');
    }
}
