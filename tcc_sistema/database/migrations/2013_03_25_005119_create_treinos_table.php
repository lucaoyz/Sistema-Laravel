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
        Schema::create('treinos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('per_id')->nullable()->constrained('personals');
            $table->string('tre_dias_semana');
            $table->string('tre_tempo');
            $table->date('tre_data_troca');
            $table->string('tre_exercicio1')->nullable();
            $table->string('tre_series1')->nullable();
            $table->string('tre_repeticoes1')->nullable();
            $table->string('tre_exercicio2')->nullable();
            $table->string('tre_series2')->nullable();
            $table->string('tre_repeticoes2')->nullable();
            $table->string('tre_exercicio3')->nullable();
            $table->string('tre_series3')->nullable();
            $table->string('tre_repeticoes3')->nullable();
            $table->string('tre_exercicio4')->nullable();
            $table->string('tre_series4')->nullable();
            $table->string('tre_repeticoes4')->nullable();
            $table->string('tre_exercicio5')->nullable();
            $table->string('tre_series5')->nullable();
            $table->string('tre_repeticoes5')->nullable();
            $table->string('tre_exercicio6')->nullable();
            $table->string('tre_series6')->nullable();
            $table->string('tre_repeticoes6')->nullable();
            $table->string('tre_exercicio7')->nullable();
            $table->string('tre_series7')->nullable();
            $table->string('tre_repeticoes7')->nullable();
            $table->string('tre_exercicio8')->nullable();
            $table->string('tre_series8')->nullable();
            $table->string('tre_repeticoes8')->nullable();
            $table->string('tre_exercicio9')->nullable();
            $table->string('tre_series9')->nullable();
            $table->string('tre_repeticoes9')->nullable();
            $table->string('tre_exercicio10')->nullable();
            $table->string('tre_series10')->nullable();
            $table->string('tre_repeticoes10')->nullable();
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
        Schema::dropIfExists('tb_treinos');
    }
};
