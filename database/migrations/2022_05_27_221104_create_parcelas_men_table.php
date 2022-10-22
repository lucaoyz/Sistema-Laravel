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
        Schema::create('parcelas_men', function (Blueprint $table) {
            $table->id();
            $table->foreignId('men_id')->nullable()->constrained('mensalidade');
            $table->foreignId('alu_id')->nullable()->constrained('alunos');
            $table->date('par_data_pagto');
            $table->string('par_status');
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
        Schema::dropIfExists('parcelas_men');
    }
};
