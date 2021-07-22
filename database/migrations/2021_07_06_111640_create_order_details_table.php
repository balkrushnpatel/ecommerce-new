<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->longText('shipping_info')->nullable();
            $table->longText('order_detail')->nullable();
            $table->string('total_amount')->nullabe();
            $table->string('discount')->nullabe();
            $table->string('discount_type')->nullabe();
            $table->string('shipping_charge')->nullabe();
            $table->string('grand_total')->nullabe();
            $table->tinyInteger('payment_type')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('user_id')
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
        Schema::dropIfExists('order_details');
    }
}
