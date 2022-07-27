<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTFarmerproductsregTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_farmerproductsreg', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('FProductId');
            $table->bigInteger('UserId')->length(20)->unsigned();
            $table->dateTime('RegDate');     
            $table->integer('ProductId')->length(10)->unsigned();
            $table->integer('Availability')->length(10);
            $table->string('Status',10); /*Pending, Approved, Cancel*/   
            $table->dateTime('AppCancellDate')->nullable();  
            $table->timestamps();
            $table->foreign('ProductId')->references('ProductId')->on('t_products');
            $table->foreign('UserId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_farmerproductsreg');
    }
}
