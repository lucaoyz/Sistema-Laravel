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
        Schema::create('mensalidade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alu_id')->constrained('alunos');
            $table->foreignId('tpg_id')->constrained('tipopagto');
            $table->date('men_data_inicio');
            $table->date('men_data_final');
            $table->date('men_data_pagto');
            $table->string('men_valor');
            $table->string('men_qtde_parcelas');
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
        Schema::dropIfExists('mensalidade');
    }
};
