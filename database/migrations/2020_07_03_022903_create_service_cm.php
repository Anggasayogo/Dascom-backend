<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_cm', function (Blueprint $table) {
            $table->increments('id_service_cm');
            $table->string('no_service_cm');
            $table->integer('service_id');
            $table->integer('customer_id');
            $table->string('tanggal');
            $table->string('status');
            $table->string('file')->nullable();
            $table->string('photo')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status_dan_keterangan')->nullable();
            $table->integer('id_ganti_parts');
            $table->string('serial_number');
            $table->string('status_unit');
            $table->string('keterangan_rusak');
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
        Schema::dropIfExists('service_cm');
    }
}
