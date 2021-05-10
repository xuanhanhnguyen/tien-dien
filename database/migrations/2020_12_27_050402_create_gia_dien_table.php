<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaDienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gia_dien', function (Blueprint $table) {
            $table->increments('ma_gia_dien');
            $table->integer('ma_loai_dien');
            $table->integer('tu_so');
            $table->integer('den_so');
            $table->integer('gia_dien');
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
        Schema::dropIfExists('gia_dien');
    }
}
