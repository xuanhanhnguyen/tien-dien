<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDienKeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dien_ke', function (Blueprint $table) {
            $table->increments('ma_dien_ke');
            $table->integer('ma_khach_hang');
            $table->integer('ma_loai_dien');
            $table->integer('so_cong_to');
            $table->integer('chi_so_cu');
            $table->integer('chi_so_moi');
            $table->boolean('trang_thai')->default(false);
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
        Schema::dropIfExists('dien_ke');
    }
}
