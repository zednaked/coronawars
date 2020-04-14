<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeamstressRequestConciliation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('seamstress_request_conciliation');
        Schema::create('seamstress_request_conciliation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masks_received');
            $table->timestamps();
            $table->unsignedInteger('seamstress_request_id');
            $table->foreign('seamstress_request_id')->references('id')->on('seamstress_request')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seamstress_request_conciliation');
    }
}