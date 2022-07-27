<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_transaction', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('TransId');
            $table->dateTime('TransDate'); 
            $table->integer('FarmerId')->length(10)->unsigned();
            $table->integer('ProductId')->length(10)->unsigned();
            $table->float('Qty',12,2)->default(0);
            $table->string('TransType',50); /*Receive/Delivery*/
            $table->timestamps();
            $table->foreign('ProductId')->references('ProductId')->on('t_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_transaction');
    }
}
