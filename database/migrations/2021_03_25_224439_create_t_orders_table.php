<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('OrdersId');
            $table->bigInteger('UserId');
            $table->dateTime('OrderDate');  
            $table->float('TotalPrice',12,2)->default(0);
            $table->string('BuyerName',50)->nullable();  
            $table->string('Phone',30)->nullable();  
            $table->string('Address',300)->nullable();  
            $table->string('Status',30); /*Order, Accept, Delivered, Cancel*/   

            $table->smallInteger('IsPayment')->default(0); /*0=not payment, 1= payment*/   
            $table->dateTime('ReadyOrCancellDate')->nullable();  
            $table->timestamps();
        });

        /*Default value insert*/
        DB::table('t_orders')->insert([
            ['OrdersId' => '1','UserId' => 1,'OrderDate' => '2022-01-01','TotalPrice' => 260,"Status"=>"Order","IsPayment"=>0],
            ['OrdersId' => '2','UserId' => 1,'OrderDate' => '2022-01-20','TotalPrice' => 90,"Status"=>"Order","IsPayment"=>0]
            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_orders');
    }
}
