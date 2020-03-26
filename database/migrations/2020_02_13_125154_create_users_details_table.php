<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->text('address_street');
            $table->text('address_street2')->nullable();
            $table->text('phone');
            $table->text('region');
            $table->text('city');
            $table->text('zipcode');
            $table->text('country');

            $table->text('b_address_street');
            $table->text('b_address_street2')->nullable();
            $table->text('b_phone');
            $table->text('b_region');
            $table->text('b_city');
            $table->text('b_zipcode');
            $table->text('b_country');
            
            $table->text('company')->nullable();
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
        Schema::dropIfExists('users_details');
    }
}
