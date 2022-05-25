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
        Schema::create('exercicios', function (Blueprint $table) {
            $table->id();
            $table->string('exe_peito');
            $table->string('exe_costas');
            $table->string('exe_biceps');
            $table->string('exe_triceps');
            $table->string('exe_antebraco');
            $table->string('exe_ombro');
            $table->string('exe_trapezio');
            $table->string('exe_inferior');
            $table->string('exe_lombar');
            $table->string('exe_abdomen');
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
        Schema::dropIfExists('exercicios');
    }
};
