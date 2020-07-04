<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintanceContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintance_contract', function (Blueprint $table) {
            $table->increments('id_me');
            $table->integer('id_customer');
            $table->integer('id_cabang');
            $table->integer('id_pm');
            $table->string('jumlah_unit');
            $table->string('kontak_person');
            $table->string('serial_number');
            $table->integer('id_ganti_parts');
            $table->string('phot')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('maintance_contract');
    }
}
