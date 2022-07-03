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
        Schema::create('treino_detalhes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eq_id')->nullable()->constrained('equipamentos');
            $table->foreignId('exe_id')->nullable()->constrained('exercicios');
            $table->foreignId('tre_id')->nullable()->constrained('treinos');
            $table->integer('td_series');
            $table->integer('td_repeticoes');
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
        Schema::dropIfExists('treino_detalhes');
    }
};
