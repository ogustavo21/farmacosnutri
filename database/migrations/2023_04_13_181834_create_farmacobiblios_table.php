<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmacobiblios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bibliografia_id')->nullable();
            $table->unsignedBigInteger('farmaco_id');
            $table->foreign('farmaco_id')->references('id')->on('farmacos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bibliografia_id')->references('id')->on('bibliografias')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('farmacobiblios');
    }
};
