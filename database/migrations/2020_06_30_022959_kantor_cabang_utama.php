<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KantorCabangUtama extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantor_cabang_utama', function (Blueprint $table) {
            $table->id('main_branch_id');
            $table->integer('regional_id');
            $table->integer('customer_id');
            $table->string('regional_name');
            $table->string('name');
            $table->string('addres');
            $table->string('email');
            $table->integer('phone');
            $table->text('description');
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
        Schema::dropIfExists('kantor_cabang_utama');
    }
}
