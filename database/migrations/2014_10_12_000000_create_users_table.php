<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usercode',20)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('userrole',20);/*Admin or Farmer*/
            $table->string('activestatus',20);/*Active or Inactive*/
            $table->string('phone',11)->unique();
            $table->string('address')->nullable();
            $table->string('nid')->nullable();
            $table->string('ImageURL',150)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        /*Default value insert*/
        $lastPostViewDate = date ( 'Y-m-d H:i:s' );
        $adminPassword = Hash::make('Admin!strat0r');
        $commonPassword = Hash::make('123');
        DB::table('users')->insert([
            ['usercode' => 'A00001','name'=>'Administrator','email' => 'administrator@mp.com','userrole' => 'Admin','activestatus' => 'Active','phone' => '01689763654','password' => $adminPassword,'address'=>'Dhaka','nid'=>'8954124574'],
            ['usercode' => 'A00002','name'=>'Pronob','email' => 'pronob@gmail.com','userrole' => 'Customer','activestatus' => 'Active','phone' => '01689763653','password' => $commonPassword,'address'=>'Dhaka','nid'=>'8954124543'],
            ['usercode' => 'A00003','name'=>'Chan','email' => 'chan@gmail.com','userrole' => 'Salesman','activestatus' => 'Active','phone' => '01689763651','password' => $commonPassword,'address'=>'Dhaka','nid'=>'8954124532']
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
