<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_product_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ProdCatId');
            $table->string('CategoryName',30)->unique();
            $table->timestamps();
        });


         /*Default value insert*/
        DB::table('t_product_category')->insert([
            ['ProdCatId' => '1','CategoryName' => 'Tablet'],
            ['ProdCatId' => '2','CategoryName' => 'Capsule'],
            ['ProdCatId' => '3','CategoryName' => 'Syrup']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_product_category');
    }
}
