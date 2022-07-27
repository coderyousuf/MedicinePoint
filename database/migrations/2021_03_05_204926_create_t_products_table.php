<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ProductId');            
            $table->integer('ProdCatId')->length(10)->unsigned();
            $table->string('ProductName',50)->unique();
            $table->float('Price',12,2)->default(0);
            $table->string('ImageURL',150)->nullable();
            $table->text('Remarks')->nullable();
            $table->integer('Availability')->length(10);
            $table->timestamps();
            $table->foreign('ProdCatId')->references('ProdCatId')->on('t_product_category');
        });

        /*Default value insert*/
        DB::table('t_products')->insert([
            ['ProductId' => '1','ProdCatId' => 1,'ProductName' => 'Napa 500mg','Price' => 1,"ImageURL"=>"products/napa.jpeg","Remarks"=>"Beximco Pharmaceuticals Ltd.",'Availability' => 600],
            ['ProductId' => '2','ProdCatId' => 1,'ProductName' => 'Ace 500mg','Price' => 1,"ImageURL"=>"products/ace.jpeg","Remarks"=>"Square Pharmaceuticals Ltd.", 'Availability' => 550],
            ['ProductId' => '3','ProdCatId' => 1,'ProductName' => 'Calbo C','Price' => 80,"ImageURL"=>"products/calboc.jpeg","Remarks"=>"Square Pharmaceuticals Ltd.",'Availability' => 50],
            ['ProductId' => '4','ProdCatId' => 1,'ProductName' => 'Fexo 120mg','Price' => 8,"ImageURL"=>"products/fexo.jpeg","Remarks"=>"Torrent Pharmaceuticals Ltd.",'Availability' => 350],
            ['ProductId' => '5','ProdCatId' => 1,'ProductName' => 'Seclo 20mg','Price' => 6,"ImageURL"=>"products/seclo.jpeg","Remarks"=>"Square Pharmaceuticals Ltd.",'Availability' => 650],
            ['ProductId' => '6','ProdCatId' => 2,'ProductName' => 'Sergel 20mg','Price' => 7,"ImageURL"=>"products/sergel.jpeg","Remarks"=>"Healthcare Pharmaceuticals Ltd.",'Availability' => 750],
            ['ProductId' => '7','ProdCatId' => 1,'ProductName' => 'Zifolet 20mg','Price' => 2,"ImageURL"=>"products/zifolet.jpeg","Remarks"=>"Square Pharmaceuticals Ltd.",'Availability' => 620],
            ['ProductId' => '8','ProdCatId' => 1,'ProductName' => 'Geston 5mg','Price' => 8,"ImageURL"=>"products/geston.jpeg","Remarks"=>"Square Pharmaceuticals Ltd.",'Availability' => 500]
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_products');
    }
}
