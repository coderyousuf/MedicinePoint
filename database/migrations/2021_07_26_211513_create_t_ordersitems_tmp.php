<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOrdersitemsTmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_ordersitems_tmp', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('OrdersItemId');
            $table->integer('OrdersId')->length(10)->unsigned();
            $table->integer('ProductId')->length(10)->unsigned();
            $table->float('Qty',12,2)->default(0);
            $table->float('UnitPrice',12,2)->default(0);
            $table->float('TotalPrice',12,2)->default(0);
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
        Schema::dropIfExists('t_ordersitems_tmp');
    }
}
