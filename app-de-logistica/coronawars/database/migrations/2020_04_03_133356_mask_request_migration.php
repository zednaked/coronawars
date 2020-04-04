<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MaskRequestMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('MaskRequest');
        Schema::create('MaskRequest', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedInteger('requested_by_user_id')->nullable(false);
            $table->unsignedInteger('delivered_by_user_id')->nullable(true);
            $table->timestamp('delivered_at')->nullable(true);
            $table->unsignedInteger('to_be_delivered_by_user_id')->nullable(true);
            $table->string('address',1000);
            $table->string('city_country',50);
            $table->string('reason',50);
            $table->string('email',50);
            $table->string('phone_number',50);
            $table->string('name',50);
            $table->integer('masks')->nullable(false);
            $table->integer('shields')->nullable(true);
            $table->timestamps();
            /*
            $table->foreign('requested_by_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('delivered_by_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('to_be_delivered_by_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('MaskRequest');
    }
}
