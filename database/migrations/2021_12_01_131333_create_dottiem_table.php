<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDottiemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dottiem', function (Blueprint $table) {
            $table->id();
            $table->string('tenDiaDiem');
            $table->date('ngayBD');
            $table->date('ngayKT');
            $table->unsignedBigInteger('phuongxa_id');
            $table->foreign('phuongxa_id')->references('id')->on('phuongxa')->onDelete('cascade');
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
        Schema::dropIfExists('dottiem');
    }
}
