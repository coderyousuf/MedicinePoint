<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOrdersitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_ordersitems', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('OrdersItemId');
            $table->integer('OrdersId')->length(10)->unsigned();
            $table->integer('ProductId')->length(10)->unsigned();
            $table->float('Qty',12,2)->default(0);
            $table->float('UnitPrice',12,2)->default(0);
            $table->float('TotalPrice',12,2)->default(0);
            $table->timestamps();
            $table->foreign('ProductId')->references('ProductId')->on('t_products');
            $table->foreign('OrdersId')->references('OrdersId')->on('t_orders');
        });

        /*Default value insert*/
        DB::table('t_ordersitems')->insert([
            ['OrdersItemId' => '1','OrdersId' => 1,'ProductId' => 2,'Qty' => 100,"UnitPrice"=>1,"TotalPrice"=>100],
            ['OrdersItemId' => '2','OrdersId' => 1,'ProductId' => 3,'Qty' => 2,"UnitPrice"=>80,"TotalPrice"=>160],

            ['OrdersItemId' => '3','OrdersId' => 2,'ProductId' => 1,'Qty' => 50,"UnitPrice"=>1,"TotalPrice"=>50],
            ['OrdersItemId' => '4','OrdersId' => 2,'ProductId' => 4,'Qty' => 5,"UnitPrice"=>8,"TotalPrice"=>40]
            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_ordersitems');
    }
}
