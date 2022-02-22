<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLieutrinhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lieutrinh', function (Blueprint $table) {
            $table->id();
            $table->integer('thangTuoi');
            $table->integer('muiTT');
            $table->unsignedBigInteger('vaccine_id');
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');
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
        Schema::dropIfExists('lieutrinh');
    }
}
