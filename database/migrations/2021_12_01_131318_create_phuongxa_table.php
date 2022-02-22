<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhuongxaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phuongxa', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('quanhuyen_id');
            $table->foreign('quanhuyen_id')->references('id')->on('quanhuyen')->onDelete('cascade');
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
        Schema::dropIfExists('phuongxa');
    }
}
