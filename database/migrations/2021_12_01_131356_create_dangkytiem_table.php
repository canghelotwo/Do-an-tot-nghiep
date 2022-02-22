<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangkytiemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangkytiem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vaccine_id');
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');
            $table->unsignedBigInteger('dottiem_id');
            $table->foreign('dottiem_id')->references('id')->on('dottiem')->onDelete('cascade');
            $table->unsignedBigInteger('kid_id');
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
            $table->date('NgayDK');
            $table->unsignedBigInteger('bacsi_id');
            $table->foreign('bacsi_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('yta_id');
            $table->foreign('yta_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('TinhTrang');
            $table->date('NgayTiem');
            $table->integer('MuiThu')->default(1);
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
        Schema::dropIfExists('dangkytiem');
    }
}
