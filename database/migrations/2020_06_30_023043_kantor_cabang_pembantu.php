<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KantorCabangPembantu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantor_cabang_pembantu', function (Blueprint $table) {
            $table->id('branch_id');
            $table->integer('main_branch_id');
            $table->integer('regional_id');
            $table->integer('customer_id');
            $table->string('name_branch');
            $table->string('addres');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
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
        Schema::dropIfExists('kantor_cabang_pembantu');
    }
}
