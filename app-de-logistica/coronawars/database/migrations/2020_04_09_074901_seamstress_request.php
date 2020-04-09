<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeamstressRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('seamstress_request');
        Schema::create('seamstress_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masks_cut');
            $table->integer('elastic');
            $table->integer('thread');
            $table->string('other',500)->nullable(true);
            $table->timestamp('delivered_at')->nullable(true);
            $table->timestamp('archived_at')->nullable(true);
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedInteger('seamstress_id');
            $table->foreign('seamstress_id')->references('id')->on('seamstress')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('MaskRequest', function (Blueprint $table) {
            //
            $table->float('geo_lon');  
            $table->float('geo_lat');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seamstress_request');
        Schema::table('MaskRequest', function (Blueprint $table) {
            $table->dropColumn('geo_lon');
            $table->dropColumn('geo_lat');
        });

    }
}
