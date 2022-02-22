<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kids', function (Blueprint $table) {
            $table->id();
            $table->string('tenNGH');
            $table->string('gioiTinh');
            $table->date('ngaySinh');
            $table->string('soTheBH');
            $table->unsignedBigInteger('nguoigiamho_id');
            $table->foreign('nguoigiamho_id')->references('id')->on('guardians')->onDelete('cascade');
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
        Schema::dropIfExists('kids');
    }
}
