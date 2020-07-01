<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Serial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serial', function (Blueprint $table) {
            $table->id('serial_id');
            $table->string('type_unit');
            $table->string('serial_number');
            $table->integer('customer_id');
            $table->integer('regional_id');
            $table->integer('main_branch_id');
            $table->integer('branch_id');
            $table->string('invoice');
            $table->integer('service_id');
            $table->string('start');
            $table->string('end');
            $table->integer('partner_id');
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
        Schema::dropIfExists('serial');
    }
}
