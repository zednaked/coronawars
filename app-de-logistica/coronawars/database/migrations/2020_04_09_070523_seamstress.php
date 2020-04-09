<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Seamstress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('seamstress');
        Schema::create('seamstress', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address',1000);
            $table->float('geo_lon',11,8)->nullable(true);  
            $table->float('geo_lat',11,8)->nullable(true);  
            $table->string('phone_number',50);
            $table->string('name',50);
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
        Schema::drop('seamstress');
    }
}
