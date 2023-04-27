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
        Schema::create('farmacos', function (Blueprint $table) {
            $table->id();
            $table->string('farmaco');
            $table->text('mecanismo');
            $table->text('url');
            $table->text('efecto');
            $table->text('recomendaciones');
            $table->unsignedBigInteger('id_grupo');
            $table->integer('estatus')->default(0);
            $table->timestamps();
            $table->foreign('id_grupo')->references('id')->on('grupofarmacos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmacos');
    }
};
