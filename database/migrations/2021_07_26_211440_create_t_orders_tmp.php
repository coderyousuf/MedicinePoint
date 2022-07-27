<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOrdersTmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_orders_tmp', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('OrdersId');
            $table->dateTime('OrderDate');  
            $table->float('TotalPrice',12,2)->default(0);
            $table->string('BuyerName',50);
            $table->string('Phone',30);
            $table->string('Address',300);
            $table->string('Status',30); /*Order, Accept, Delivered, Cancel*/   

            $table->smallInteger('IsPayment')->default(0); /*0=not payment, 1= payment*/   
            $table->dateTime('ReadyOrCancellDate')->nullable();  
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
        Schema::dropIfExists('t_orders_tmp');
    }
}
