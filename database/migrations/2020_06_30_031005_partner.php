<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Partner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner', function (Blueprint $table) {
            $table->increments('partner_id');
            $table->string('nama_partner_dealer');
            $table->string('addres');
            $table->string('name');
            $table->string('email');
            $table->integer('phone');
            $table->string('logo');
            $table->string('partner_status');
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
        Schema::dropIfExists('partner');
    }
}
