<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('salesman_id')->default(1);
            $table->timestamp('order_date');
            $table->text('address_street');
            $table->text('address_street2')->nullable();
            $table->text('phone');
            $table->integer('region');
            $table->integer('city');
            $table->integer('country');
            $table->text('zipcode');
            $table->float('order_tax');
            $table->float('order_shipping_cost');
            $table->float('coupon_discount');
            $table->float('discount');
            $table->float('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
